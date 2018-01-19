// Include gulp and plugins
var gulp        = require('gulp');
var cache       = require('gulp-cached');
var sass        = require('gulp-sass');
var cleanCSS 		= require('gulp-clean-css');
var neat        = require('node-neat').includePaths;
var concat      = require('gulp-concat');
var uglify      = require('gulp-uglify');
var rename      = require('gulp-rename');
var gutil       = require('gulp-util');
var svgo        = require('gulp-svgo');
var iconfont    = require('gulp-iconfont');
var iconfontCss = require('gulp-iconfont-css');
var livereload  = require('gulp-livereload');
var autoprefixer = require('gulp-autoprefixer');

var path = '../../plugins/abt-rtp-sircus-viewer/js';

var onError = function (err) {
	gutil.beep();
	console.log(err);
};

// Compile Our Sass
gulp.task('sass', function() {
	return gulp.src('css/scss/**/*.scss')
	.on('error', onError)
	.pipe(sass({
		includePaths: ['styles'].concat(neat)
	}))
	.pipe(autoprefixer({
		browsers: ['last 3 versions'],
		cascade: false
	}))
	.pipe(gulp.dest('css'))
	.pipe(livereload());
});

gulp.task('minify-css', () => {
  return gulp.src('css/style.css')
    .pipe(cleanCSS({compatibility: '*'}))
		.pipe(rename('style.min.css'))
    .pipe(gulp.dest('css'));
});

// Concatenate & Minify JS
gulp.task('scripts', function() {
	return gulp.src(['js/vendors/*.js', 'js/init.js'])
	.pipe(concat('scripts.js'))
	.pipe(gulp.dest('js'))
	.pipe(uglify())
	.pipe(rename('scripts.min.js'))
	.pipe(gulp.dest('js'))
	.pipe(livereload());
});
gulp.task('scripts-page-home', function() {
	return gulp.src(['js/page-home.js'])
	.pipe(uglify())
	.pipe(rename('page-home.min.js'))
	.pipe(gulp.dest('js'))
	.pipe(livereload());
});
gulp.task('scripts-page-infographics', function() {
	return gulp.src(['js/page-infographics.js'])
	.pipe(uglify())
	.pipe(rename('page-infographics.min.js'))
	.pipe(gulp.dest('js'))
	.pipe(livereload());
});
gulp.task('scripts-page-people', function() {
	return gulp.src(['js/page-people.js'])
	.pipe(uglify())
	.pipe(rename('page-people.min.js'))
	.pipe(gulp.dest('js'))
	.pipe(livereload());
});
gulp.task('scripts-page-events', function() {
	return gulp.src(['js/page-events.js'])
	.pipe(uglify())
	.pipe(rename('page-events.min.js'))
	.pipe(gulp.dest('js'))
	.pipe(livereload());
});
gulp.task('scripts-page-events-calendar', function() {
	return gulp.src(['js/events.calendar.custom.js'])
	.pipe(uglify())
	.pipe(rename('events.calendar.custom.min.js'))
	.pipe(gulp.dest('js'))
	.pipe(livereload());
});
gulp.task('scripts-page-frontier', function() {
	return gulp.src(['js/page-frontier.js'])
	.pipe(uglify())
	.pipe(rename('page-frontier.min.js'))
	.pipe(gulp.dest('js'))
	.pipe(livereload());
});
gulp.task('scripts-page-stem', function() {
	return gulp.src(['js/page-stem.js'])
	.pipe(uglify())
	.pipe(rename('page-stem.min.js'))
	.pipe(gulp.dest('js'))
	.pipe(livereload());
});
gulp.task('scripts-page-thelab', function() {
	return gulp.src(['js/page-thelab.js'])
	.pipe(uglify())
	.pipe(rename('page-thelab.min.js'))
	.pipe(gulp.dest('js'))
	.pipe(livereload());
});
gulp.task('sircus-scripts', function() {
	return gulp.src([
		path + '/plugin/angular/angular-sanitize.min.js',
		path + '/plugin/libs/ng-infinite-scroll.min.js',
		path + '/plugin/libs/angular-local-storage.js',
		path + '/plugin/libs/angular-isotope.js',
		path + '/plugin/libs/Autolinker.min.js',
		path + '/plugin/app/main/app.js',
		path + '/plugin/app/filters/*.js',
		path + '/plugin/app/services/*.js',
		path + '/plugin/app/controllers/*.js',
		path + '/plugin/app/directives/*.js',
		path + '/plugin/libs/wp/social-feed/social.feed.lib.js'
	])
	.pipe(concat('sircus-viewer.js'))
	.pipe(gulp.dest(path))
	.pipe(uglify())
	.pipe(rename('sircus-viewer.min.js'))
	.pipe(gulp.dest(path))
	.pipe(livereload());
});

// Minify SVG images
gulp.task('svg', function() {
	return gulp.src('img/**/*.svg')
	.pipe(svgo())
	.pipe(gulp.dest('img'));
});


// SVG to web font generator
var fontName = 'customIcons';

gulp.task('iconfont', function(){
	gulp.src(['img/icons/*.svg'])
	.pipe(iconfontCss({
		fontName: fontName,
		targetPath: '../../css/scss/base/_icons.scss',
		fontPath: '../fonts/icons/'
	}))
	.pipe(iconfont({
		fontName: fontName,
		appendCodepoints: true,
		normalize: true,
		fontHeight: 500
	}))
	.pipe(gulp.dest('fonts/icons/'));
});


// Watch Files For Changes
gulp.task('watch', function() {
	livereload.listen();
	gulp.watch('js/init.js', ['scripts']);
	gulp.watch('js/vendors/*.js', ['scripts']);
	gulp.watch('js/page-home.js', ['scripts-page-home']);
	gulp.watch('js/page-infographics.js', ['scripts-page-infographics']);
	gulp.watch('js/page-people.js', ['scripts-page-people']);
	gulp.watch('js/page-events.js', ['scripts-page-events']);
	gulp.watch('js/events.calendar.custom.js', ['scripts-page-events-calendar']);
	gulp.watch('js/page-frontier.js', ['scripts-page-frontier']);
	gulp.watch('js/page-stem.js', ['scripts-page-stem']);
	gulp.watch('js/page-thelab.js', ['scripts-page-thelab']);
	gulp.watch(path + '/plugin/**/*.js', ['sircus-scripts']);
	gulp.watch('css/scss/**/*.scss', ['sass', 'minify-css']);
	gulp.watch('img/**/*.svg', ['svg']);
});

// Default Task
gulp.task('default', [
	'sass',
	'minify-css',
	'svg',
	'scripts',
	'scripts-page-home',
	'scripts-page-infographics',
	'scripts-page-people',
	'scripts-page-events',
	'scripts-page-frontier',
	'scripts-page-stem',
	'scripts-page-thelab',
	'sircus-scripts',
	'scripts-page-events-calendar'
]);
