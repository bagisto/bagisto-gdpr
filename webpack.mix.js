const { mix } = require('laravel-mix');

require('laravel-mix-merge-manifest');

let publicPath = '../../../public/vendor/webkul/gdpr/assets';

if (mix.inProduction()) {
    publicPath = 'publishable/assets';
}

mix.setPublicPath(publicPath).mergeManifest();

mix.disableNotifications();

mix
    .sass(
        __dirname + '/src/Resources/assets/sass/gdpr.scss',
        __dirname + '/' + publicPath + '/css/gdpr.css',
        {
            includePaths: ['node_modules/bootstrap-sass/assets/stylesheets/']
        }
    )

    .options({
        processCssUrls: false
    });

if (mix.inProduction()) {
    mix.version();
}
