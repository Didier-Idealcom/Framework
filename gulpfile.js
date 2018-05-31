var gulp = require('gulp'),
    //path = require('path'),
    //fs = require('fs'),
    image = require('gulp-image'),
    include = require('gulp-include'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    sourcemaps = require('gulp-sourcemaps'),
    sass = require('gulp-sass'),
    csslint = require('gulp-csslint'),
    sasslint = require('gulp-sass-lint'),
    jslint = require('gulp-jslint');

gulp.task('sass', function() {
    return gulp.src(['site/templates/**/sass/*.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed', // nested, expanded, compact, compressed
            //includePaths: ['vendor/zurb/foundation/scss']
        }).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(rename(function(path) {
            path.dirname += '/../css';
            //path.extname = '.min.css';
        }))
        .pipe(gulp.dest(function(file) {
            return file.base;
        }));
});

gulp.task('js', function() {
    return gulp.src(['resources/assets/js/test/*.js', '!**/_*'])
        .pipe(sourcemaps.init())
        .pipe(include())
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public/js/test'));
});

gulp.task('image', function () {
    return gulp.src('public/images/*')
        .pipe(image())
        .pipe(gulp.dest(function(file) {
            return file.base;
        }));
});

gulp.task('csslint', function() {
    return gulp.src(['site/templates/**/*.css'])
        .pipe(csslint())
        .pipe(csslint.formatter());
});

gulp.task('sasslint', function () {
    return gulp.src(['site/templates/**/.scss'])
        .pipe(sasslint())
        .pipe(sassLint.format())
        .pipe(sassLint.failOnError());
});

gulp.task('jslint', function () {
    return gulp.src(['site/templates/**/*.js'])
        .pipe(jslint())
        .pipe(jslint.reporter('default'));
});

gulp.task('lint', ['csslint', 'sasslint', 'jslint'], function() {

});

gulp.task('default', ['sass', 'js'], function() {

});

gulp.task('watch', function() {
    //gulp.watch('site/templates/**/sass/*.scss', ['sass']);
    gulp.watch('resources/assets/js/test/*.js', ['js']);
});
