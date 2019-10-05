let gulp = require('gulp');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename'); 
var notify = require("gulp-notify");
var gulpCopy = require('gulp-copy');
let cleanCSS = require('gulp-clean-css');
let sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const javascriptObfuscator = require('gulp-javascript-obfuscator');
var realFavicon = require ('gulp-real-favicon');
var fs = require('fs');

var cssOptions = {
    debug: true, 
    compatibility: 'ie10',
    level: {
        1: { all: true },
        2: { all: true },
    },
};
var jsOptions = {
    output: {
        comments: /^!/,
    },
    compress: {
        arguments: true,
        booleans: true,
        conditionals: true,
        collapse_vars: true,
        dead_code: true,
        directives: true,
        drop_console: true,
        drop_debugger: true,
        evaluate: true,
        hoist_funs: true,
    },
    mangle: { 
        toplevel: true 
    } 
};



// File where the favicon markups are stored
var FAVICON_DATA_FILE = 'faviconData.json';

// Generate the icons. This task takes a few seconds to complete.
// You should run it at least once to create the icons. Then,
// you should run it whenever RealFaviconGenerator updates its
// package (see the check-for-favicon-update task below).
gulp.task('olimpus-generate-favicon', function(done) {
    realFavicon.generateFavicon({
        masterPicture: 'src/layouts/olimpuss/imgs/icons/logo.png',
        dest: 'public/assets/imgs/icons',
        iconsPath: 'https://olimpussoft.com/assets/icons',
        design: {
            ios: {
                pictureAspect: 'backgroundAndMargin',
                backgroundColor: '#67b868',
                margin: '7%',
                assets: {
                    ios6AndPriorIcons: true,
                    ios7AndLaterIcons: true,
                    precomposedIcons: true,
                    declareOnlyDefaultIcon: true
                },
                appName: 'Olimpus Soft'
            },
            desktopBrowser: {},
            windows: {
                pictureAspect: 'noChange',
                backgroundColor: '#67b868',
                onConflict: 'override',
                assets: {
                    windows80Ie10Tile: true,
                    windows10Ie11EdgeTiles: {
                        small: true,
                        medium: true,
                        big: true,
                        rectangle: true
                    }
                },
                appName: 'Olimpus Soft'
            },
            androidChrome: {
                pictureAspect: 'noChange',
                themeColor: '#67b868',
                manifest: {
                    name: 'Olimpus Soft',
                    startUrl: 'https://olimpusoft.com',
                    display: 'standalone',
                    orientation: 'notSet',
                    onConflict: 'override',
                    declared: true
                },
                assets: {
                    legacyIcon: true,
                    lowResolutionIcons: true
                }
            },
            safariPinnedTab: {
                pictureAspect: 'silhouette',
                themeColor: '#67b868'
            }
        },
        settings: {
            compression: 3,
            scalingAlgorithm: 'Cubic',
            errorOnImageTooSmall: false,
            readmeFile: true,
            htmlCodeFile: true,
            usePathAsIs: false
        },
        markupFile: FAVICON_DATA_FILE
    }, function() {
        done();
    });
});

// Inject the favicon markups in your HTML pages. You should run
// this task whenever you modify a page. You can keep this task
// as is or refactor your existing HTML pipeline.
gulp.task('inject-favicon-markups', function() {
    return gulp.src([ 'src/root/favicon.html' ])
        .pipe(realFavicon.injectFaviconMarkups(JSON.parse(fs.readFileSync(FAVICON_DATA_FILE)).favicon.html_code))
        .pipe(gulp.dest('public/'));
});

// Check for updates on RealFaviconGenerator (think: Apple has just
// released a new Touch icon along with the latest version of iOS).
// Run this task from time to time. Ideally, make it part of your
// continuous integration system.
gulp.task('check-for-favicon-update', function(done) {
    var currentVersion = JSON.parse(fs.readFileSync(FAVICON_DATA_FILE)).version;
    realFavicon.checkForUpdates(currentVersion, function(err) {
        if (err) {
            throw err;
        }
    });
});

gulp.task('olimpuss-minify-css', () => {
  return gulp.src('src/layouts/olimpuss/styles/*.css')
  	.pipe(sourcemaps.init())
    .pipe(cleanCSS(cssOptions, (details) => {
      console.log(`${details.name}: ${details.stats.originalSize} --> ${details.stats.minifiedSize}`);
    }))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('public/assets/css'))
    .pipe(sourcemaps.write())
    ;
});

gulp.task('olimpuss-copy-fonts', () => {
	return gulp
    .src(['src/layouts/olimpuss/fonts/**/*.*'])
    //.pipe(gulpCopy('public/assets/font'))
    .pipe(gulp.dest('public/assets/font'))
    ;
});

gulp.task('olimpuss-compress-scripts', function () {
    return gulp.src('src/layouts/olimpuss/js/*.js')
    .pipe(uglify(jsOptions)) 
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('public/assets/js'))
    .pipe(notify({
        message: 'Scripts task complete!',
        onLast : true
    }));
});

gulp.task('olimpuss', gulp.series('olimpuss-minify-css', 'olimpuss-compress-scripts', 'olimpuss-copy-fonts'));
