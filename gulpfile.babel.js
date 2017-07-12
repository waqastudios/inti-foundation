'use strict';

import plugins       from 'gulp-load-plugins';
import yargs         from 'yargs';
import browser       from 'browser-sync';
import gulp          from 'gulp';
import rimraf        from 'rimraf';
import sherpa        from 'style-sherpa';
import yaml          from 'js-yaml';
import fs            from 'fs';
import webpackStream from 'webpack-stream';
import webpack2      from 'webpack';
import named         from 'vinyl-named';

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
 gulp.series(clean, gulp.parallel(sass, foundationjs, vendorjs, images, copyFonts, copyStaticCss, editorSass), styleGuide));

// Build the site, run the server, and watch for file changes
gulp.task('default',
  gulp.series('build', server, watch));

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
    .pipe(gulp.dest(PATHS.dist + '/fonts'));
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
    .pipe($.autoprefixer({
      browsers: COMPATIBILITY
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
    .pipe($.autoprefixer({
      browsers: COMPATIBILITY
    }))
    .pipe(gulp.dest(PATHS.dist + '/css'));
}


let webpackConfig = {
  rules: [
    {
      test: /.js$/,
      use: [
        {
          loader: 'babel-loader'
        }
      ]
    }
  ]
}
// Combine JavaScript into one file
// In production, the file is minified
function foundationjs() {
  return gulp.src(PATHS.foundationjs)
    .pipe(named())
    .pipe($.sourcemaps.init())
    .pipe(webpackStream({module: webpackConfig}, webpack2))
    .pipe($.if(PRODUCTION, $.uglify()
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
    .pipe(webpackStream({module: webpackConfig}, webpack2))
    .pipe($.if(PRODUCTION, $.uglify()
      .on('error', e => { console.log(e); })
    ))
    .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
    .pipe(gulp.dest(PATHS.dist + '/js'));
}
// Copy images to the "dist" folder
// In production, the images are compressed
function images() {
  return gulp.src('library/src/img/**/*')
    .pipe($.if(PRODUCTION, $.imagemin({
      progressive: true
    })))
    .pipe(gulp.dest(PATHS.dist + '/img'));
}

// Start a server with BrowserSync to preview the site in
function server(done) {
  browser.init({
    // server: PATHS.dist, port: PORT
    proxy: PROXY
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
  gulp.watch(PATHS.static, copyFonts, copyStaticCss);
  gulp.watch('library/src/scss/**/*.scss').on('all', sass);
  gulp.watch('library/src/js/**/*.js').on('all', gulp.series(foundationjs, browser.reload));
  gulp.watch('library/src/img/**/*').on('all', gulp.series(images, browser.reload));
  gulp.watch('library/src/styleguide/**').on('all', gulp.series(styleGuide, browser.reload));
}
