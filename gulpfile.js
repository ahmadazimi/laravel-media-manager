//////////////////////////////////////////////////
// REQUIRE
//////////////////////////////////////////////////

var gulp = require('gulp');

// UTIL
var clean = require('gulp-clean');

//////////////////////////////////////////////////
// Tasks
//////////////////////////////////////////////////

gulp.task('elfinder', function() {
  return gulp.src([
    'build/php/**/*'
  ])
    .pipe(gulp.dest('src/core'));
});

gulp.task('extra', function() {
  return gulp.src([
    'extra/**/*'
  ])
    .pipe(gulp.dest('src/core'));
});

gulp.task('public', function() {
  return gulp.src([
    'build/{js,css,img}/**/*',
	'build/elfinder.html'
  ])
    .pipe(gulp.dest('public'));
});

//////////////////////////////////////////////////
// WATCH Tasks
//////////////////////////////////////////////////

gulp.task('js:watch', function () {
  gulp.watch(paths.app.assets + '/js/**/*.js', ['js:pub']);
});

gulp.task('less:watch', function () {
  gulp.watch(paths.app.assets + '/less/**/*.less', ['css:pub']);
});

//////////////////////////////////////////////////
// CLEAN Tasks
//////////////////////////////////////////////////

gulp.task('clean', function () {
  return gulp.src([
    'build/**/*',
	'!build/.gitignore',
    'public/**/*',
	'src/core/**/*'
  ])
    .pipe(clean());
});


//////////////////////////////////////////////////
// Default Task
//////////////////////////////////////////////////

gulp.task('default', ['elfinder', 'extra', 'public']);
