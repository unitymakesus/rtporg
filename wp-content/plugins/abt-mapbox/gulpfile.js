// Include gulp and plugins
var gulp   = require('gulp');
var	concat = require('gulp-concat');
var	uglify = require('gulp-uglify');
var	rename = require('gulp-rename');
var	watch  = require('gulp-watch');

// Concatenate & Minify JS
gulp.task('scripts', function() {
  return gulp.src('js/src/*.js')
  .pipe(concat('abt-map.js'))
  .pipe(gulp.dest('js/dist'))
  .pipe(uglify({
  	mangle: false
  }))
  .pipe(rename('abt-map.min.js'))
  .pipe(gulp.dest('js/dist'));
});

// Default Task
gulp.task('default', [ 'scripts' ]);

// Watch Task
gulp.task('watch', function() {
  gulp.watch('js/src/*.js', ['scripts']);
});
