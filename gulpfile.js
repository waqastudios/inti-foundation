// Grab our gulp packages
var gulp  = require('gulp'),
    gutil = require('gulp-util'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    plumber = require('gulp-plumber'),
    bower = require('gulp-bower')
    
// Compile Sass, Autoprefix and minify
gulp.task('styles', function() {
  return gulp.src('./library/scss/**/*.scss')
    .pipe(plumber(function(error) {
            gutil.log(gutil.colors.red(error.message));
            this.emit('end');
    }))
    .pipe(sass())
    .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
    .pipe(gulp.dest('./library/css/'))     
    .pipe(rename({suffix: '-min'}))
    .pipe(minifycss())
    .pipe(gulp.dest('./library/css/'))
});    
    
// JSHint, concat, and minify JavaScript
gulp.task('site-js', function() {
  return gulp.src([	
	  
           // Grab your custom scripts
  		  './library/js/scripts/*.js'
  		  
  ])
    .pipe(plumber())
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('inti.js'))
    .pipe(gulp.dest('./library/js'))
    .pipe(rename({suffix: '-min'}))
    .pipe(uglify())
    .pipe(gulp.dest('./library/js'))
});    

// JSHint, concat, and minify Foundation JavaScript
gulp.task('vendor-js', function() {
  return gulp.src([	
  		  
  		  // Call all required vendor files

        //if you won't use WP jquery
          //'./library/vendor/jquery/dist/jquery.js',


          './library/vendor/modernizr/modernizr.js',
          './library/vendor/what-input/what-input.js',
          './library/vendor/toastr/toastr.js',
          './library/vendor/slick/dist/slick.js',
          './library/vendor/jQuery-Flex-Vertical-Center/jquery.flexverticalcenter.js',
          './library/vendor/motion-ui/motion-ui.js',
          './library/vendor/jquery.cookie/jquery.cookie.js'
          
  ])
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(gulp.dest('./library/js'))
    .pipe(rename({suffix: '-min'}))
    .pipe(uglify())
    .pipe(gulp.dest('./library/js'))
});

// JSHint, concat, and minify Foundation JavaScript
gulp.task('foundation-js', function() {
  return gulp.src([	
  		  
  		  // Foundation core - needed if you want to use any of the components below
          './library/vendor/foundation-sites/js/foundation.core.js',
          './library/vendor/foundation-sites/js/foundation.util.*.js',
          
          // Pick the components you need in your project
          './library/vendor/foundation-sites/js/foundation.abide.js',
          './library/vendor/foundation-sites/js/foundation.accordion.js',
          './library/vendor/foundation-sites/js/foundation.accordionMenu.js',
          './library/vendor/foundation-sites/js/foundation.drilldown.js',
          './library/vendor/foundation-sites/js/foundation.dropdown.js',
          './library/vendor/foundation-sites/js/foundation.dropdownMenu.js',
          './library/vendor/foundation-sites/js/foundation.equalizer.js',
          './library/vendor/foundation-sites/js/foundation.interchange.js',
          './library/vendor/foundation-sites/js/foundation.magellan.js',
          './library/vendor/foundation-sites/js/foundation.offcanvas.js',
          './library/vendor/foundation-sites/js/foundation.orbit.js',
          './library/vendor/foundation-sites/js/foundation.responsiveMenu.js',
          './library/vendor/foundation-sites/js/foundation.responsiveToggle.js',
          './library/vendor/foundation-sites/js/foundation.reveal.js',
          './library/vendor/foundation-sites/js/foundation.slider.js',
          './library/vendor/foundation-sites/js/foundation.sticky.js',
          './library/vendor/foundation-sites/js/foundation.tabs.js',
          './library/vendor/foundation-sites/js/foundation.toggler.js',
          './library/vendor/foundation-sites/js/foundation.tooltip.js',
          './library/vendor/foundation-sites/js/motion-ui.js'
  ])
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('foundation.js'))
    .pipe(gulp.dest('./library/js'))
    .pipe(rename({suffix: '-min'}))
    .pipe(uglify())
    .pipe(gulp.dest('./library/js'))
});

// Update Foundation with Bower and save to /vendor
gulp.task('bower', function() {
  return bower({ cmd: 'update'})
    .pipe(gulp.dest('library/vendor/'))
});    

// Create a default task 
gulp.task('default', function() {
  gulp.start('styles', 'site-js', 'vendor-js', 'foundation-js');
});

// Watch files for changes
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('./library/scss/**/*.scss', ['styles']);

  // Watch site-js files
  gulp.watch('./library/js/scripts/*.js', ['site-js']);
  
  // Watch foundation-js files
  gulp.watch('./library/vendor/foundation-sites/js/*.js', ['foundation-js']);

});
