var gulp = require('gulp');
var bust = require('gulp-buster');

var plugins = require('gulp-load-plugins')({
  'config': require('./package.json'),
  'pattern': ['*'],
  'scope': ['dependencies','devDependencies']
});

gulp.task('sass:front', require('./tasks/sass')(gulp, plugins, 'front/main', '../symfony/public/css', false));
gulp.task('sass:middle', require('./tasks/sass')(gulp, plugins, 'middle/middle', '../symfony/public/css', false));
gulp.task('webpack:front', require('./tasks/webpack')(gulp, plugins, 'front/main', '../symfony/public/js'));
gulp.task('webpack:middle', require('./tasks/webpack')(gulp, plugins, 'middle/main', '../symfony/public/js'));

gulp.task('copy-vendor', require('./tasks/copy-vendor')(gulp, plugins));


// Optional
gulp.task('iconfont', require('./tasks/iconfont')(gulp, plugins));

// Main

// Main
gulp.task('versioning', function() {
  var srcGlob =  ['../symfony/public/css/middle/middle.min.css', '../symfony/public/css/front/main.min.css', '../symfony/public/js/front/main.min.js', '../symfony/public/js/middle/main.min.js'] ;
  return gulp.src(srcGlob, {allowEmpty:true})
    .pipe(bust({ relativePath: '../symfony/public/'}))
    .pipe(gulp.dest('../symfony/public/'));
});

gulp.task('sass', gulp.parallel('sass:front', 'sass:middle', 'versioning'));

gulp.task('webpack', gulp.parallel('webpack:front', 'webpack:middle', 'versioning'));


// Watch
gulp.task('watch:middle:sass', function () {
  gulp.watch(['./sass/middle/**/*.scss', './sass/common/**/*.scss'] , gulp.series('sass:middle'));
});
gulp.task('watch:front:sass', function () {
  gulp.watch(['./sass/front/**/*.scss', './sass/common/**/*.scss'], gulp.series('sass:front'));
});
gulp.task('watch:front:js', function () {
  gulp.watch('./js/front/*.js', gulp.series('webpack'));
});
gulp.task('watch:middle:js', function () {
  gulp.watch('./js/middle/*.js', gulp.series('webpack'));
});
gulp.task('watch:iconfont', function () {
  gulp.watch('./fonts/iconfont/*.svg', gulp.series('iconfont'));
});

gulp.task('watch', gulp.parallel('sass', 'webpack', 'watch:middle:sass', 'watch:front:sass', 'watch:front:js', 'watch:middle:js', 'watch:iconfont'));

gulp.task('default', gulp.parallel('copy-vendor', 'sass', 'webpack'));
