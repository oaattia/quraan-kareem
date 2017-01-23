<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>{{ trans('app.title') }} - @yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet">

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    @if(config('app.locale') != 'ar')
        <link rel="stylesheet" href="{{ asset('css/skeleton.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/skeleton-rtl.css') }}">
    @endif

    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    @yield('styles')

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>

@yield('content')
<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

@yield('scripts')
</body>
</html>
