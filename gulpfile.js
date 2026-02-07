const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cssSorter = require("css-declaration-sorter");
const mmq = require("gulp-merge-media-queries");
const browserSync = require("browser-sync");
const cleanCss = require("gulp-clean-css");
const uglify = require("gulp-uglify");
const rename = require("gulp-rename");
const htmlBeautify = require("gulp-html-beautify");
const sharp = require('sharp');
const path = require('path');

async function convertToWebpSharp() {
  const gulp = require('gulp');
  const { readdir, readFile, writeFile } = require('fs').promises;
  
  const imgDir = 'public/assets/img';
  const files = await readdir(imgDir);
  const imageFiles = files.filter(f => /\.(jpg|jpeg|png)$/i.test(f));
  
  for (const file of imageFiles) {
    const inputPath = path.join(imgDir, file);
    const outputPath = path.join(imgDir, path.basename(file, path.extname(file)) + '.webp');
    const buffer = await readFile(inputPath);
    await sharp(buffer).webp({ quality: 80 }).toFile(outputPath);
    console.log('Converted:', file, '->', path.basename(outputPath));
  }
}

function convertToWebpSharpTask(done) {
  convertToWebpSharp().then(() => done()).catch(done);
}




function test(done) {
  console.log("Hello Gulp");
  done();
}

function compileSass() {
  return gulp
    .src("./src/assets/sass/**/*.scss")
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssSorter({ order: "alphabetical" })]))
    .pipe(mmq())
    .pipe(gulp.dest("./public/assets/css"))
    .pipe(cleanCss())
    .pipe(
      rename({
        suffix: ".min",
      })
    )
    .pipe(gulp.dest("./public/assets/css"));
}
// ------監視--------
function watch() {
  gulp.watch(
    "./src/assets/sass/**/*.scss",
    gulp.series(compileSass, browserReload)
  );
  gulp.watch("./src/assets/js/**/*.js", gulp.series(minJS, browserReload));
}

// --- ブラウザ自動リロード ---
function browserInit(done) {
  browserSync.init({
    proxy: "http://ryota-portforio.local/", // WordPress ローカル URL
    files: [
      "./**/*.php",
      "./public/assets/css/**/*.css",
      "./public/assets/js/**/*.js",
    ],
    notify: false,
  });
  done();
}

function browserReload(done) {
  browserSync.reload();
  done();
}

function minJS() {
  return gulp
    .src("./src/assets/js/**/*.js")
    .pipe(gulp.dest("./public/assets/js"))
    .pipe(uglify())
    .pipe(
      rename({
        suffix: ".min",
      })
    )
    .pipe(gulp.dest("./public/assets/js"));
}

function formatHTML() {
  return gulp
    .src("./src/**/*.html")
    .pipe(
      htmlBeautify({
        indent_size: 2,
        indent_with_tabs: true,
      })
    )
    .pipe(gulp.dest("./public"));
}

exports.convertToWebpSharp = convertToWebpSharpTask;
exports.test = test;
exports.compileSass = compileSass;
exports.watch = watch;
exports.browserInit = browserInit;
exports.dev = gulp.parallel(browserInit, watch);
exports.minJS = minJS;
exports.formatHTML = formatHTML;
exports.build = gulp.parallel(formatHTML, minJS, compileSass);
exports.default = gulp.series(
  compileSass,
  minJS,
  formatHTML,
  gulp.parallel(browserInit, watch)
);
