//MIX CSS AND JS TO PUBLIC FOLDERS

let mix = require('laravel-mix');

mix.setPublicPath('public');

//compile sass
mix.sass(
    'resources/assets/sass/app.scss',
    'public/css/all.css'
);

mix.js(
    'resources/assets/js/app.js',
    'public/js/all.js'
    );