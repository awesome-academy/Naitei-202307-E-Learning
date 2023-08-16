const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js/app.js')
    .js('resources/js/main.js', 'public/js/main.js')
    .js('resources/js/localization.js', 'public/js/localization.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/font.scss', 'public/css')
    .sass('resources/sass/learning.scss', 'public/css')
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ])
    .postCss("resources/css/main.css", "public/css", [
        require("tailwindcss"),
    ])
    .postCss("resources/css/landingpage.css", "public/css", [
        require("tailwindcss"),
    ]);

mix.webpackConfig({
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /node_modules\/(?!alpinejs|vue|toastr\/|other-package\/).*/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env'],
                },
            },
        }],
    },
});
