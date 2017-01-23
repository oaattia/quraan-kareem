const elixir = require('laravel-elixir');

//require('laravel-elixir-vue-2');


elixir(mix => {

    mix.styles([
      'normalize.css',
      'skeleton.css'
    ], 'public/css/skeleton.css')

    .styles([
      'normalize.css',
      'skeleton-rtl.css'
    ], 'public/css/skeleton-rtl.css')

    .styles('awesomplete.css')

    .styles('app.css', 'public/css/app.css').version('css/app.css')

    .webpack('home/index.js', 'public/js/home_index.js');
});
