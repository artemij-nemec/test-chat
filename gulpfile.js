var gulp = require('gulp'),
    concat = require('gulp-concat'), // ������� ������
    uglify = require('gulp-uglify'),
    babel = require('gulp-babel'); // ����������� JS

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