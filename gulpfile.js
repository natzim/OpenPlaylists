var gulp = require('gulp');
var concat = require('gulp-concat');

gulp.task('js', function() {
    var input = [
        'resources/assets/vendor/jquery/dist/jquery.js',
        'resources/assets/vendor/bootswatch-dist/js/bootstrap.js',
        'resources/assets/vendor/bootstrap-treeview/src/js/bootstrap-treeview.js',
        'resources/assets/app.js'
    ];

    gulp.src(input)
        .pipe(concat('app.js'))
        .pipe(gulp.dest('public/js'));
});

gulp.task('css', function() {
    var input = [
        'resources/assets/vendor/bootswatch-dist/css/bootstrap.css',
        'resources/assets/vendor/font-awesome/css/font-awesome.css'
    ];

    gulp.src(input)
        .pipe(concat('style.css'))
        .pipe(gulp.dest('public/css'));

    gulp.src('resources/assets/vendor/font-awesome/fonts/*')
        .pipe(gulp.dest('public/fonts'));
});

gulp.task('default', [
    'js',
    'css'
]);