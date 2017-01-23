const elixir = require('laravel-elixir');

//require('laravel-elixir-vue-2');


elixir(mix => {

    mix.styles([
      'normalize.css',
      'skeleton.css'
    ], 'public/css/skeleton.css');

    mix.styles('app.css', 'public/css/app.css').version('css/app.css');

});
