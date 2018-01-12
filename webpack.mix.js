let mix = require('laravel-mix');

mix.js('resources/assets/js/slim.js', 'public/js/app.js')
    .sass('resources/assets/sass/app.scss', 'public/css');
