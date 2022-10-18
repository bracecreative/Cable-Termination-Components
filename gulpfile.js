var gulp = require('gulp'),
 rename = require('gulp-rename'),
 watch = require('gulp-watch'),
 minify = require('gulp-minify'),
 browserSync = require('browser-sync').create(),
 postcss = require('gulp-postcss'),
 autopre = require('autoprefixer'),
 csswring = require('csswring'),
 sass = require('gulp-sass'),
 uglify = require('gulp-uglify');
var url = 'https://localhost/ctcuk';
gulp.task('watch', function () {
 browserSync.init({
   proxy: url,
   ghostMode: false
 });
 watch('./js/*.js', gulp.series('scripts'));
 watch('./scss/**/*.scss', gulp.series('styles'));
 watch('./**/*.php', function (done) {
   browserSync.reload();
   done;
 });
});
gulp.task('scripts', function () {
 return gulp.src('./js/scripts.js')
   .pipe(uglify())
   .pipe(rename({
     suffix: '.min'
   }))
   .pipe(gulp.dest('./js/min'));
});
gulp.task('load', function () {
 browserSync.reload();
});
gulp.task('styles', function (done) {
 return gulp.src('./scss/main.scss')
   .pipe(sass())
   .pipe(postcss([autopre]))
   .pipe(gulp.dest('./css/'))
   .pipe(postcss([csswring]))
   .pipe(rename({
     basename: 'main.min'
   }))
   .pipe(gulp.dest('./css/min'))
   .pipe(browserSync.stream());
 done();

 
});
gulp.task('default', function (done) {
 console.log('Default Working');
 done();
});

