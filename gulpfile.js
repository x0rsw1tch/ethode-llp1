var gulp = require('gulp');
var sass = require('gulp-sass');

var sassFiles = [
	'resources/assets/sass/vue-material/core.scss',
	'resources/assets/sass/app.scss',
];

gulp.src('resources/assets/css/vue-material.css')
  .pipe(gulp.dest('public/assets/css'));

gulp.task('sass', function(){  
    gulp.src(sassFiles)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('public/assets/css'));
});

gulp.task('default', ['sass']);

gulp.task('watch', function() {
    gulp.watch('resources/assets/sass/app.scss', ['sass'])
});
