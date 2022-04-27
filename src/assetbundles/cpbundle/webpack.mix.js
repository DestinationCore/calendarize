const mix = require('laravel-mix');

mix.js('src/js/app.js', 'dist/js/main.js')
    .sass("src/scss/app.scss", "css/app.css")
    .setPublicPath('dist');

// Do not generate a mix-manifest.json file as Craft handles version strings, etc. so we have no use for the file.
mix.options({ manifest: false })

// Do not create `main.js.LICENSE.txt` file.
mix.options({
    terser: {
        extractComments: (astNode, comment) => false,
        terserOptions: {
            format: {
                comments: false,
            }
        }
    }
});