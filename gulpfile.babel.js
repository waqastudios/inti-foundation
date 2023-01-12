var plugins       = require('gulp-load-plugins');
var yargs         = require('yargs');
var browser       = require('browser-sync');
var gulp          = require('gulp');
var rimraf        = require('rimraf');
var sherpa        = require('style-sherpa');
var dateFormat    = require('dateformat');
var yaml          = require('js-yaml');
var fs            = require('fs');
var webpackStream = require('webpack-stream');
var webpack4      = require('webpack');
var named         = require('vinyl-named');
var autoprefixer  = require('gulp-autoprefixer');
var imagemin      = require('gulp-imagemin');
var terser        = require('gulp-terser');
var sourcemaps    = require('gulp-sourcemaps');


// Load all Gulp plugins into one variable
const $ = plugins();

// Check for --production flag
const PRODUCTION = !!(yargs.argv.production);

// Load settings from settings.yml
const { COMPATIBILITY, HOST, PORT, PROXY, PATHS } = loadConfig();

function loadConfig() {
  let ymlFile = fs.readFileSync('config.yml', 'utf8');
  return yaml.load(ymlFile);
}



// Build the "dist" folder by running all of the below tasks
gulp.task('build',
 gulp.series(
  clean, 
  sass, 
  foundationjs, 
  vendorjs, 
  images, 
  copyFonts, 
  copyStaticCss, 
  editorSass, 
  styleGuide,
  // archive
  )
 );

// Build the site, run the server, and watch for file changes
gulp.task('default',
  gulp.series('build', server, watch));

// Package the WP theme
gulp.task('package',
  gulp.series('build', archive));



// Delete the "dist" folder
// This happens every time a build starts
function clean(done) {
  rimraf(PATHS.dist, done);
}

// Copy files
// These tasks skip over the normal "img", "js", and "scss" folders, which are parsed separately
// Copies webfonts from the font src to dist
function copyFonts() {
  return gulp.src(PATHS.staticfonts)
    .pipe(gulp.dest(PATHS.dist + '/webfonts'));
}
// Copies vendor CSS files that we don't want to parse or combine( for individual enqueue in styles.php)
function copyStaticCss() {
  return gulp.src(PATHS.staticcss)
    .pipe(gulp.dest(PATHS.dist + '/css'));
}




// Generate a style guide from the Markdown content and HTML template in styleguide/
function styleGuide(done) {
  sherpa('library/src/styleguide/index.md', {
    output: PATHS.dist + '/styleguide.html',
    template: 'library/src/styleguide/template.html'
  }, done);
}

// Compile Sass into CSS
// In production, the CSS is compressed
function sass() {
  return gulp.src('library/src/scss/inti.scss')
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      includePaths: PATHS.sass
    })
      .on('error', $.sass.logError))
    .pipe(autoprefixer({
      overrideBrowserslist: COMPATIBILITY
    }))
    .pipe($.if(PRODUCTION, $.cleanCss({ compatibility: 'ie9' })))
    .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
    .pipe(gulp.dest(PATHS.dist + '/css'))
    .pipe(browser.reload({ stream: true }));
}
// Compile Css for Editor
function editorSass() {
  return gulp.src('library/src/scss/editor.scss')
    .pipe($.sass({
      includePaths: PATHS.editorsass
    })
      .on('error', $.sass.logError))
    .pipe(autoprefixer({
      overrideBrowserslist: COMPATIBILITY
    }))
    .pipe(gulp.dest(PATHS.dist + '/css'));
}



var webpackConfig = {
  mode: 'development',
  module: {
    rules: [
      {
        test: /.js$/,
        use: [
          {
            loader: 'babel-loader',
            options: {
              plugins: ["@babel/plugin-transform-shorthand-properties"],
              presets: ["@babel/preset-env"]
            }
          }
        ]
      }
    ]
  }
}

// Combine JavaScript into one file
// In production, the file is minified
function foundationjs() {
  return gulp.src(PATHS.foundationjs)
    .pipe(named())
    .pipe($.sourcemaps.init())
    .pipe(webpackStream(webpackConfig, webpack4))
    .pipe($.if(PRODUCTION, $.terser({
      compress: {}
    })
     .on('error', e => { console.log(e); })
    ))
    .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
    .pipe(gulp.dest(PATHS.dist + '/js'));
}

// Combine JavaScript into one file
// In production, the file is minified
function vendorjs() {
  return gulp.src(PATHS.vendorjs)
    .pipe(named())
    .pipe($.sourcemaps.init())
    .pipe($.if(PRODUCTION, $.terser()
     .on('error', e => { console.log(e); })
    ))
    .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
    .pipe(gulp.dest(PATHS.dist + '/js'));
}
// Copy images to the "dist" folder
// In production, the images are compressed
function images() {
  return gulp.src('library/src/img/**/*')
    .pipe($.if(PRODUCTION, imagemin()))
    .pipe(gulp.dest(PATHS.dist + '/img'));
}

// Create a .zip archive of the theme
function archive() {
  var time = dateFormat(new Date(), "yyyy-mm-dd_HH-MM");
  var pkg = JSON.parse(fs.readFileSync('./package.json'));
  var title = pkg.name + '_' + time + '.zip';

  return gulp.src(PATHS.package)
    .pipe($.zip(title))
    .pipe(gulp.dest('packaged'));
}

// Start a server with BrowserSync to preview the site in
function server(done) {
  browser.init({
    //server: PATHS.dist, port: PORT
    proxy: PROXY,
    open: false,
    https: true,
  });
  done();
}

// Reload the browser with BrowserSync
function reload(done) {
  browser.reload();
  done();
}

// Watch for changes to static, Sass, and JavaScript
function watch() {
  gulp.watch(PATHS.staticfonts, copyFonts);
  gulp.watch(PATHS.staticcss, copyStaticCss);
  gulp.watch('library/src/scss/**/*.scss').on('all', sass);
  gulp.watch('library/src/js/**/*.js').on('all', gulp.series(foundationjs, browser.reload));
  gulp.watch('library/src/img/**/*').on('all', gulp.series(images, browser.reload));
  gulp.watch('library/src/styleguide/**').on('all', gulp.series(styleGuide, browser.reload));
}
