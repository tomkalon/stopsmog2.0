const Encore = require('@symfony/webpack-encore');
const path = require('path');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')
    .copyFiles({
        from: 'assets/images/',
        to: 'images/[name].[hash:8].[ext]',
        pattern: /\.(png|jpg|jpeg|webp|svg)$/
    })
    .copyFiles({
        from: 'assets/js/models',
        to: 'js/[name].[hash:8].[ext]',
        pattern: /\.(js|json)$/
    })
    .copyFiles({
        from: 'assets/js/bootstrap',
        to: 'js/[name].[hash:8].[ext]',
        pattern: /\.(js|json)$/
    })

    .addAliases({
        // MODELS
        '@Models': path.resolve(__dirname, 'assets/js/models'),

        // MODULES
        '@Api': path.resolve(__dirname, 'assets/js/modules/Api'),
        '@Routing': path.resolve(__dirname, 'assets/js/modules/Routing'),
        '@Routes': path.resolve(__dirname, 'public/js/routes.json'),
        '@FosRoutes': path.resolve(__dirname, 'vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js'),

        // COMPONENTS
        '@ReactComponent': path.resolve(__dirname, 'assets/react/components')
    })

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    .enableReactPreset()

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })

    // enables and configure @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    .enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
