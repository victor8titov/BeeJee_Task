const gulp = require('gulp');

const sass = require('gulp-sass');
const postcss           = require('gulp-postcss');
const autoprefixer      = require('autoprefixer');
const qcmq              = require('gulp-group-css-media-queries');
const cssnano           = require('gulp-cssnano');

const debug = require('gulp-debug');
const sourcemaps = require('gulp-sourcemaps');
const plumber = require('gulp-plumber');
const notify  = require('gulp-notify'); //Выводит подсвеченный синтаксис ошибки в потоке и попап окно
const rename = require('gulp-rename');

//          Browser - Sync
const browserSync = require('browser-sync').create();

gulp.task('sass',function(){
    return gulp.src('src/scss/main.scss')
    .pipe(sourcemaps.init())
    .pipe(plumber({errorHandler: notify.onError()}))
    .pipe(sass())
    .pipe(debug())
    .pipe(rename('main.css'))
    .pipe(sourcemaps.write('logfile'))
    .pipe(gulp.dest('assets/css/'));
});

gulp.task('styles:build', function () {
    return gulp.src( ['src/scss/main.scss'] )
        .pipe(plumber({errorHandler: notify.onError()}))
        .pipe(sass())
        .pipe(debug())
        .pipe(qcmq())
        .pipe(debug())
        .pipe(postcss([ autoprefixer({
            overrideBrowserslist: ['cover 99.5%'] 
        }) ]))
        .pipe(debug())
        .pipe(cssnano())
        .pipe(rename('main.css'))
        .pipe(gulp.dest( 'assets/css' ));
});



gulp.task('server', function(){

    browserSync.init({
        poxy: 'http://work.test.beejee/',
        });
    browserSync.watch(['assets/**/*.*','**/*.php']).on('change', browserSync.reload);

});

gulp.task('server:reload', function(callback){
    browserSync.reload();    
    callback();
});
gulp.task('server:pause', function(callback){
    browserSync.pause();
    callback();
});
gulp.task('server:resume', function(callback){
    browserSync.resume();
    callback();
});
gulp.task('server:exit', function(callback){
    browserSync.exit();
    callback();
});


gulp.task('watch:styles',function() {

    gulp.watch( [ 'src/scss/**/*.{sass,scss}', '!node_modules/**/*.{sass,scss}'], gulp.series('sass', 'server:reload'));
        
});



gulp.task( 'dev', gulp.parallel( 'server', 'watch:styles') 
);
