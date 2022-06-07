//Inicializando modulos
const {src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const rename = require('gulp-rename');
const autoprefixer = require ('autoprefixer');
const GulpClient = require('gulp');
const purgecss = require('gulp-purgecss');
const browsersync = require ('browser-sync').create();

//Copy file JS a to folder proyect
const files = {
    htmlPath: './*.html',
    scssPath:'./scss/**/*.scss',
    jsPath:'./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'
};
//HTML Task
function htmlTask(){
    return src(files.htmlPath)
    //.pipe(htmlmin({ collapseWhitespac : true}))
    .pipe(dest('./'));
};
//Creando el servidor y los archivos que se compilaran
function scssTask(){
    return src(files.scssPath)
    .pipe (sass().on('Error',sass.logError))
    .pipe(dest('./assets/css'))
};
exports.scssTask = scssTask;

//Copiando el js del modulo de boostrap
function jsTask (){
    return src(files.jsPath)
    .pipe(dest('assets/js'))
};
exports.jsTask = jsTask;
// Reduce file css not use bootstrap
function purgecssTask() {
     return src('./assets/css/*.css')
         .pipe(purgecss({
             content: ['./index.html']
         }))
         .pipe(rename('./reducido.css'))
         .pipe(dest('./assets/css'))
};
exports.purgecssTask = purgecssTask;
//Watch task:SCSS and JS Files for changes
function watchTask(){
    watch(files.scssPath, parallel(scssTask, browserSyncReload));
}
//Server browserSyncServe
function browserSyncServe(done){
    browsersync.init({
        server:{
            baseDir: './',
        },
    });
    //Reload HTML when change 
    watch('*.html').on('change', browsersync.reload);
    done();
};
//Reload Server
function browserSyncReload(done){
    browsersync.reload();
    done();
};
//Run command
exports.default =series(
    parallel (scssTask, jsTask,htmlTask,purgecssTask),
    browserSyncServe,
    watchTask
);