var elixir = require('laravel-elixir');

elixir(function(mix) {


    // Frontend

    mix.less(['admin/dashboard.less'], 'public/css/admin-dashboard.css', {compress:true});


    // Backend

    mix.less(['front/paper-gateway.less'], 'public/css/paper-gateway-theme.css', {compress:true});

});
