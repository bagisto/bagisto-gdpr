const mix = require("laravel-mix");
require("laravel-mix-merge-manifest");

if (mix.inProduction()) {
  var publicPath = "publishable/assets";
} else {
  var publicPath = "../../../public/vendor/webkul/gdpr/assets";
}

mix.setPublicPath(publicPath).mergeManifest();

mix.disableNotifications();

mix
  .sass(__dirname + "/src/Resources/assets/sass/app.scss", "css/gdpr.css")
  .options({
    processCssUrls: false
  });

if (mix.inProduction()) {
  mix.version();
}