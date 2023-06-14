<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Practice</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="app" class="antialiased bg-gray-100 dark:bg-gray-900 h-screen">
@include('layouts.header')

<main class="pt-12 font-semibold text-gray-800 dark:text-white mb:flex mb:items-center mb:justify-center ">
    <div class="container mx-auto">
        @yield('content')
    </div>
</main>
</body>
</html>
