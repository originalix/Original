var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    del = require('del');

var paths = {
    sassSrcPath: ['src/styles/*.scss'],
    scriptSrcPath: ['src/scripts/*.js'],
    imageSrcPath: ['src/images/*']
}

// 编译sass、自动添加css前缀和压缩
gulp.task('styles', function() {
  return gulp.src(paths.sassSrcPath)
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(gulp.dest('dist/assets/css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(minifycss())
    .pipe(gulp.dest('dist/assets/css'))
    .pipe(notify({ message: 'Styles task complete' }));
});

// js代码校验、合并和压缩
gulp.task('scripts', function() {
  return gulp.src(paths.scriptSrcPath)
    .pipe(jshint())
    .pipe(jshint.reporter('default'))
    .pipe(concat('main.js'))
    .pipe(gulp.dest('dist/assets/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('dist/assets/js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// 压缩图片
gulp.task('images', function() {
  return gulp.src(paths.imageSrcPath)
    .pipe(cache(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true })))
    .pipe(gulp.dest('dist/assets/img'))
    .pipe(notify({ message: 'Images task complete' }));
});

// 清除文件
gulp.task('clean', function(cb) {
  del(['dist/assets/css', 'dist/assets/js', 'dist/assets/img'], cb());
});

// 先celan任务 之后回调做剩余操作
gulp.task('default', ['clean'], function() {
  gulp.start('styles', 'scripts', 'images');
});

// 监听文件变动
gulp.task('watch', function() {
  gulp.watch(paths.sassSrcPath, ['styles']);
  gulp.watch(paths.scriptSrcPath, ['scripts']);
  gulp.watch(paths.imageSrcPath, ['images']);
});

gulp.task('css', () => {
  const postcss = require('gulp-postcss');
  const sourcemaps = require('gulp-sourcemaps');

  return gulp.src('src/**/*.css')
    .pipe( sourcemaps.init() )
    .pipe( postcss([ require('precss'), require('autoprefixer') ]) )
    .pipe( sourcemaps.write('.') )
    .pipe( gulp.dest('build/') );
});
