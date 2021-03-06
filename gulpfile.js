var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy("bower_components/uikit/scss","resources/assets/sass/uikit");
    mix.copy("bower_components/semantic-ui-card/card.css","public/css/card.css");
    mix.copy("bower_components/chartist/dist/chartist.min.css","public/css/chartist.min.css");
    mix.copy("bower_components/chartist/dist/chartist.js","resources/js/chartist.js");
    mix.copy("bower_components/uikit/js","resources/js");
    mix.copy("bower_components/jquery/dist/jquery.js","resources/js/jquery.js");
    mix.copy("bower_components/uikit/fonts","public/build/fonts");
    mix.scripts([
        "jquery.js",
        "uikit.js",
        "components/sortable.js",
        "components/upload.js",
        "components/form-select.js",
        "components/datepicker.js",
        "jquery.restfulizer.js",
        "chartist.js",
        "app.js"
    ]);
    mix.sass('app.sass');
    mix.stylesIn("public/css");
    mix.version(["css/all.css","js/all.js"]);
});
