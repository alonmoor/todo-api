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
//var handlebars = require('gulp-ember-handlebars');

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

// gulp.task("imagemin", function () {
//   return gulp
//     .src("./themes/custom/bootstrap_sass/images/*")
//     .pipe(
//       imagemin({
//         progressive: true,
//         svgoPlugins: [{ removeViewBox: false }],
//         use: [pngquant()],
//       })
//     )
//     .pipe(gulp.dest("./themes/custom/bootstrap_sass/images"));
// });

gulp.task("clean-css", function () {
  return del([
    // "./server/public/app/assets/*",
    "./server/public/css/*",
  ]);
});

// gulp.task("clean-css", function () {
//     return del([
//         "./themes/custom/bootstrap_sass/css/*",
//         "./themes/custom/bootstrap_sass/cssrtl/*",
//     ]);
// });


gulp.task("sass",gulp.series('clean-css', function(){
  gulp
    .src("./client/app/styles/*.scss")
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    .pipe(autoprefixer.apply(null, supportedBrowsers))
    .pipe(sourcemaps.write("./"))
  //  .pipe(gulp.dest("./server/public/app/assets"));
      .pipe(gulp.dest("./server/public/css"));
}));

gulp.task("css", gulp.series('sass', function(){
  gulp
    .src("./client/app/styles/*.scss")
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: "compact" }).on("error", sass.logError))
    .pipe(sass().on("error", sass.logError))
    .pipe(autoprefixer.apply(null, supportedBrowsers))
    .pipe(rtlcss())
    .pipe(sourcemaps.write("./"))
    //.pipe(gulp.dest("./server/public/app/assets"))
      .pipe(gulp.dest("./server/public/css"))
    .pipe(livereload());
}));

// gulp.task("uglify", function () {
//   gulp
//     .src("./themes/custom/bootstrap_sass/lib/*.js")
//     .pipe(uglify("main.js"))
//     .pipe(gulp.dest("./themes/custom/bootstrap_sass/js"));
// });

gulp.task( gulp.series('livereload', function(){
  livereload();
}));

gulp.task(gulp.series('watch', function(){
  livereload.listen();

}));


gulp.watch("./client/app/styles/*.scss", gulp.series('css'));
gulp.watch("./server/public/css/client.css",gulp.series('slivereload', function(){

}));

gulp.task("default", gulp.series('css'));
