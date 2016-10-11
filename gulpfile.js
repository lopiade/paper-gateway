var elixir = require('laravel-elixir');

elixir(function(mix) {


    // Frontend CSS
    mix.less(['admin/dashboard.less'], 'public/css/admin-dashboard.css', {compress:true});


    // Backend CSS
    mix.less(['front/paper-gateway.less'], 'public/css/paper-gateway-theme.css', {compress:true});


    // JS App
    mix.browserify('app.js','public/js/paper-gateway.js');


});
