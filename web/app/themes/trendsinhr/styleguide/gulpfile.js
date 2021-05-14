// Load plugins
var gulp = require('gulp'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  autoprefixer = require('gulp-autoprefixer'),
  cleanCSS = require('gulp-clean-css'),
  jshint = require('gulp-jshint'),
  uglify = require('gulp-uglify'),
  rename = require('gulp-rename'),
  concat = require('gulp-concat'),
  livereload = require('gulp-livereload'),
  plumber = require('gulp-plumber'),
  notify = require('gulp-notify');

function style() {
  return (
    gulp
    .src('assets/src/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({style: 'compressed',}).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(rename({suffix: '.min'}))
    .pipe(cleanCSS({compatibility: 'ie11', specialComments: 0}))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('assets/dist/css'))
    .pipe(livereload())
  );
}

function scripts() {
  return (
    gulp
    .src('assets/src/scripts/**/*.js')
    .pipe(jshint.reporter('default'))
    .pipe(concat('scripts.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(plumber())
    .pipe(uglify().on('error', console.error))
    .pipe(gulp.dest('assets/dist/js'))
  );
}

function vendors() {
  return (
    gulp
    .src([
    // 'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
    'node_modules/slick-carousel/slick/slick.min.js',
    'node_modules/magnific-popup/dist/jquery.magnific-popup.min.js',
    'node_modules/aos/dist/aos.js',
    'assets/src/vendors/**/*.js'
  ])
    .pipe(jshint.reporter('default'))
    .pipe(concat('vendors.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('assets/dist/js'))
  );
}

function fractalStart() {
  const fractal = require('./fractal/fractal.js');
  const logger = fractal.cli.console;
  const server = fractal.web.server({
    sync: true,
    port: 8888
  });
  server.on('error', err => logger.error(err.message));
  return server.start().then(() => {
    logger.success(`Fractal server is now running at ${server.url}`);
  });
}

function fractalBuild() {
  const fractal = require('./fractal/fractal.js');
  const logger = fractal.cli.console;
  const builder = fractal.web.builder();
  builder.on('progress', (completed, total) => logger.update(`Exported ${completed} of ${total} items`, 'info'));
  builder.on('error', err => logger.error(err.message));
  return builder.build().then(() => {
    logger.success('Fractal build completed!');
  });
}

function fractalWatch(){
  fractalStart();
  watch();
}


function watch(){
  livereload.listen();
  gulp.watch('assets/src/scss/**/*.scss', style)
  gulp.watch('assets/src/scripts/**/*.js', scripts);
}

exports.watch = watch
exports.vendors = vendors
exports.fractalStart = fractalStart
exports.fractalBuild = fractalBuild
exports.fractalWatch = fractalWatch
