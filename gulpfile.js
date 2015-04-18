var gulp = require('gulp');
var concat = require('gulp-concat');

gulp.task('js', function() {
    var input = [
        'resources/assets/jquery/dist/jquery.js',
        'resources/assets/bootswatch-dist/js/bootstrap.js',
        'resources/assets/bootstrap-treeview/src/js/bootstrap-treeview.js'
    ];

    gulp.src(input)
        .pipe(concat('app.js'))
        .pipe(gulp.dest('public/js'));
});

gulp.task('css', function() {
    var input = [
        'resources/assets/bootswatch-dist/css/bootstrap.css',
        'resources/assets/font-awesome/css/font-awesome.css'
    ];

    gulp.src(input)
        .pipe(concat('style.css'))
        .pipe(gulp.dest('public/css'));

    gulp.src('resources/assets/font-awesome/fonts/*')
        .pipe(gulp.dest('public/fonts'));
});

gulp.task('default', [
    'js',
    'css'
]);