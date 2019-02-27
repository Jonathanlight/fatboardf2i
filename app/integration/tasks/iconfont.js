var fontName = 'plus_de_points';
module.exports = function (gulp, plugins) {
  return function () {
    return gulp.src(['./fonts/iconfont/*.svg'], { base: './' })
    .pipe(plugins.iconfontCss({
      fontName: fontName,
      path: './sass/common/mixins/_fonts-icon.scss',
      targetPath: './../../../../integration/sass/common/components/_iconfont.scss',
      fixedCodepoints : true,
      fontPath: '../../fonts/icons/',
    }))
    .pipe(plugins.iconfont({
     fontName: fontName,
     formats: ['svg', 'ttf', 'eot', 'woff', 'woff2'],
     normalize: true,
     descent : 0,
     centerHorizontally : true,
     fontWeight : 1001,
    }))
    .on('glyphs', function(glyphs) {
      //  console.log(glyphs);
    })
    .pipe(gulp.dest('../symfony/public/fonts/icons/'));
  };
};
