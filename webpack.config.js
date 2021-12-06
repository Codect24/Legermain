const Encore = require('@symfony/webpack-encore');

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
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')
    .addEntry('styles/echoppe', './assets/styles/echoppe.scss')
    .addEntry('styles/dashboard', './assets/styles/dashboard.scss')
    .addEntry('styles/produit', './assets/styles/produit.scss')
    .addEntry('styles/panier', './assets/styles/panier.scss')
    .addEntry('styles/article', './assets/styles/article.scss')
    .addEntry('styles/article_show', './assets/styles/article_show.scss')
    .addEntry('js/menu', './assets/js/menu.js')
    .addEntry('styles/inscription','./assets/styles/inscription.scss')
    .addEntry('styles/connexion','./assets/styles/connexion.scss')
    .addEntry('js/tabs', './assets/js/tabs.js')
    .addEntry('js/entryForm', './assets/js/entryForm.js')

    .addEntry('styles/jobs', './assets/styles/jobs.scss')
    .addEntry('styles/jobOffer', './assets/styles/jobOffer.scss')
    .addEntry('styles/account', './assets/styles/account.scss')
    .addEntry('styles/reset', './assets/styles/reset.scss')
    .addEntry('styles/request', './assets/styles/request.scss')

    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[ext]',
    })

    .copyFiles({
        from: './assets/styles/fonts',
        to: 'fonts/[path][name].[ext]',
    })
    .addEntry('styles/realisation', './assets/styles/realisation.scss')
    .addEntry('js/realisation', './assets/js/realisation.js')

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

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

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
