// Initialize modules
// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const {src, dest, watch, series, parallel} = require('gulp');
// Importing all the Gulp-related packages we want to use
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const babel = require('gulp-babel');
const gutil = require('gulp-util');
const browserSync = require('browser-sync').create();
const imagemin = require('gulp-imagemin');
const clean = require('gulp-clean');

// File paths
const files = {
    scssPath: 'scss/**/*.scss',
    js: {
        libs: 'js/libs/*.js',
        app: 'js/app.js',
    },
    images: 'images/**/*.{jpg,jpeg,png,svg,gif}',
    fonts: 'fonts/*',
    dist: '../dist'
};

// check is Production
function isProduction() {
    return gutil.env.hasOwnProperty('production') && gutil.env.production === true;
}

// Sass task: compiles the style.scss file into style.css
function scssTask() {
    return src(files.scssPath)
        .pipe(isProduction() ? gutil.noop() : sourcemaps.init()) // initialize sourcemaps first
        .pipe(sass()) // compile SCSS to CSS
        .pipe(postcss([autoprefixer(), cssnano()])) // PostCSS plugins
        .pipe(isProduction() ? gutil.noop() : sourcemaps.write('./')) // write sourcemaps file in current directory
        .pipe(dest(files.dist)) // put final CSS in dist folder
        .pipe(browserSync.reload({stream: true}))
}

// JS task: concatenates and uglifies JS files to script.js
function jsTask() {
    return src([
        files.js.libs,
        files.js.app,
    ])
        .pipe(concat('app.js'))
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(uglify())
        .pipe(dest(files.dist));
}

// Images task: compress and copy images
function imagesTask() {
    return src(files.images)
        .pipe(isProduction() ? imagemin() : gutil.noop())
        .pipe(dest((files.dist + '/images').toString()))
}

// copy fonts to dest directory
function copyFontsTask() {
    return src(files.fonts)
        .pipe(dest((files.dist + '/fonts').toString()));
}

// clean directory before build project
function cleanTask() {
    return src('../dist/*')
        .pipe(clean({force: true}));
}

// browserSync task: start browserSync server
function server() {
    browserSync.init({
        proxy: "tracking.local"
    });
}

// Watch task: watch SCSS and JS files for changes
// If any change, run scss and js tasks simultaneously
function watchTask() {
    watch([files.scssPath, files.js.libs, files.js.app, files.images, files.fonts],
        series(
            cleanTask,
            parallel(copyFontsTask, scssTask, jsTask, imagesTask)
        )
    );
}

// build tasks
exports.build = series(
    cleanTask,
    parallel(copyFontsTask, scssTask, jsTask, imagesTask)
);

// default gulp tasks
exports.default = series(
    cleanTask,
    parallel(copyFontsTask, scssTask, jsTask, imagesTask),
    watchTask
);


// default dev tasks
exports.dev = series(
    cleanTask,
    parallel(copyFontsTask, scssTask, jsTask, imagesTask, watchTask, server)
);
