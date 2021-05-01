var gulp = require("gulp");
var livereload = require("gulp-livereload");
var uglify = require("gulp-uglifyjs");
var sass = require("gulp-sass");
var autoprefixer = require("gulp-autoprefixer");
var sourcemaps = require("gulp-sourcemaps");
var imagemin = require("gulp-imagemin");
var pngquant = require("imagemin-pngquant");
var rtlcss = require("gulp-rtlcss");
var del = require("del");

// Don't hoist the autoprefixer to here, as it will cause reference sharing and tasks overriding each other's output
const supportedBrowsers = [
  "last 2 version",
  "safari 5",
  "ie 7",
  "ie 8",
  "ie 9",
  "ie 10",
  "ie 11",
  "opera 12.1",
  "ios 6",
  "android 4",
];

gulp.task("imagemin", function () {
  return gulp
    .src("./themes/custom/bootstrap_sass/images/*")
    .pipe(
      imagemin({
        progressive: true,
        svgoPlugins: [{ removeViewBox: false }],
        use: [pngquant()],
      })
    )
    .pipe(gulp.dest("./themes/custom/bootstrap_sass/images"));
});

gulp.task("clean-css", function () {
  return del([
    "/public/css/*",
    "/public/cssrtl/*",
  ]);
});

// gulp.task("clean-css", function () {
//     return del([
//         "./themes/custom/bootstrap_sass/css/*",
//         "./themes/custom/bootstrap_sass/cssrtl/*",
//     ]);
// });


gulp.task("sass", ["clean-css"], function () {
  gulp
    .src("./sass/*.scss")
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    .pipe(autoprefixer.apply(null, supportedBrowsers))
    .pipe(sourcemaps.write("./"))
    .pipe(gulp.dest("../public/css"));
});

gulp.task("css", ["sass"], function () {
  gulp
    .src("./sass/*.scss")
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: "compact" }).on("error", sass.logError))
    .pipe(sass().on("error", sass.logError))
    .pipe(autoprefixer.apply(null, supportedBrowsers))
    .pipe(rtlcss())
    .pipe(sourcemaps.write("./"))
    .pipe(gulp.dest("../public/css"))
    .pipe(livereload());
});

// gulp.task("uglify", function () {
//   gulp
//     .src("./themes/custom/bootstrap_sass/lib/*.js")
//     .pipe(uglify("main.js"))
//     .pipe(gulp.dest("./themes/custom/bootstrap_sass/js"));
// });

gulp.task("livereload", function () {
  livereload();
});

gulp.task("watch", function () {
  livereload.listen();

  gulp.watch("./sass/*.scss", ["css"]);
  gulp.watch("./js/*.js", ["uglify"]);
  // gulp.watch(['./themes/custom/bootstrap_sass/css/style.css', './themes/custom/bootstrap_sass/**/*.twig', './themes/custom/bootstrap_sass/js/*.js'], function (files){
  //   livereload.changed(files)
  // });

  gulp.watch(
    [
      "../public/css/app.css",
      "../public/js/*.js",
    ],
    ["livereload"]
  );
});

gulp.task("default", ["css"]);
