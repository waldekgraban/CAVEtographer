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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


/**
 * Browsersync
 */
if (yn(process.env.MIX_BROWSERSYNC_ENABLED)) {
    const target = process.env.MIX_BROWSERSYNC_TARGET || 'localhost:8000';

    const host = process.env.MIX_BROWSERSYNC_HOST || 'localhost';
    const port = process.env.MIX_BROWSERSYNC_PORT || 3000;

    let config = {
        host: host,
        port: port,
        proxy: {
            target: target,
            reqHeaders: function () {
                return {
                    host: `${host}:${port}`
                };
            }
        }
    };

    if (yn(process.env.MIX_BROWSERSYNC_EXTENDED)) {
        config.watchEvents = ['change', 'add'];
        config.files = [
            'app/**/*.php',
            'resources/views/**/*.php',
            'resources/js/components/**/*.vue',
            'public/js/**/*.js',
            'public/css/**/*.css',
        ];
        config.ui = false;
        config.ghostMode = false;
    }

    mix.browserSync(config);
}

function yn(value) {
    if (value === 'false' || value === '0') {
        return false;
    }

    if (value === 'true' || value === '1') {
        return true;
    }

    return !!value;
}