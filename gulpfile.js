var elixir = require('laravel-elixir'),
  gulp = require('gulp'),
  del = require('del'),
  templateCache = require('gulp-angular-templatecache'),
  htmlMin = require('gulp-htmlmin'),
  htmlify = require('gulp-angular-htmlify'),
  templateSrc = 'public/partials/**/*.html',
  templateDest = 'resources/assets/js/modules';

elixir.extend('compress', function() {
  new elixir.Task('compress', function() {
      return gulp.src([
        './storage/framework/views/*'
      ])
        .pipe(htmlMin({
          collapseWhitespace: true,
          removeAttributeQuotes: true,
          removeComments: true,
          minifyJS: true,
        }))
        .pipe(gulp.dest('./storage/framework/views/'));
    })
    .watch('./storage/framework/views/*');
});
/**
 * Delete old files
 * @param  string path single or array of paths to files or folders that we want to delete
 * @return file system delete
 */
elixir.extend('delete', function (path) {
    new elixir.Task('delete', function () {
        del(path);
    });
});

elixir(function(mix) {
  mix.delete(['public/build/css/*','public/build/js/*','public/build/fonts/*','public/images/*']);
  mix.sass('app.scss')
    // Run and watch template cache task
    .task('templatecache', templateSrc)
    .browserify('app.js')
    .version(['css/app.css', 'js/app.js'])
    // Copy fonts
    .copy('resources/assets/fonts', 'public/build/fonts')
    .copy('resources/assets/images', 'public/images')
    // run browsersync. When proxying php artisan use:
    // $ php artisan serve --host=0
    .browserSync({
      proxy: 'http://modsvar.dev',
      port: 8000
    });


});

gulp.task('templatecache', function() {
  return gulp.src(templateSrc)
    .pipe(htmlify())
    .pipe(htmlMin({
      collapseWhitespace: true,
      removeComments: true,
      removeRedundantAttributes: true,
      removeAttributeQuotes: true,
      minifyJS: true,
      minifyCSS: true
    }))
    .pipe(templateCache('template-cache.js', {
      root: '/partials/',
      module: 'templateCache',
      standalone: true
    }))
    .pipe(gulp.dest(templateDest));
});
