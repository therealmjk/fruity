var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .addEntry('app', './assets/js/app.js')
    .addEntry('fruits', './assets/js/fruits.js')
    .addEntry('favorites', './assets/js/favorites.js')
    .enableSassLoader()
    .enableStimulusBridge('./assets/controllers.json')
    .enableSingleRuntimeChunk()
    .enableVueLoader()
;

module.exports = Encore.getWebpackConfig();