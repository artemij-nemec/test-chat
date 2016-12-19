var gulp = require('gulp'),
    concat = require('gulp-concat'), // Склейка файлов
    uglify = require('gulp-uglify'),
    babel = require('gulp-babel'); // Минификация JS

gulp.task('minify', function() {
    // js
    return gulp.src('web/js/models/*.js')
        .pipe(concat('index.js'))
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(uglify())
        .pipe(gulp.dest('web/build'));

});