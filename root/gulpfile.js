var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var cleanCSS = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
//var minify = require('gulp-minify');

gulp.task('sass', function() {
	return gulp.src('sass/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(cleanCSS())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('css'));
});

gulp.task('cmssass', function() {
	return gulp.src('cms/sass/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(cleanCSS())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('cms/css'));
});
 
gulp.task('scripts', function() {
	return gulp.src([
		'js/wrap/_open.txt',
		'js/scripts/articlesFullOverview.js',
		'js/scripts/articlesHomepage.js',
		'js/scripts/articleSlider.js',
		'js/scripts/comments.js',
		'js/scripts/darkmode.js',		
		'js/scripts/detailForm.js',
		'js/scripts/eventsSlider.js',
		'js/scripts/header.js',
		'js/scripts/menu.js',
		'js/scripts/submenu.js',
		'js/scripts/moreButton.js',		
		'js/scripts/moreButtonArticles.js',
		'js/scripts/search.js',
		'js/scripts/spotify.js',
		'js/wrap/_close.txt'
	])
		.pipe(concat('main.js'))
		.pipe(uglify())
		.pipe(gulp.dest('js'));
});

gulp.task('watch', function() {
	gulp.watch('sass/**/*.scss', gulp.series('sass'));
	gulp.watch('cms/sass/*.scss', gulp.series('cmssass'));
	gulp.watch('js/scripts/*.js', gulp.series('scripts'));
});