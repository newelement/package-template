const mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'publishable/assets/js')
    .sass('resources/assets/sass/app.scss', 'publishable/assets/css');
