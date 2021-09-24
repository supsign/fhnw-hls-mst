<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="{{ isset($robots) ? $robots : 'noindex,nofollow' }}"/>
        <meta name="description" content="{{ isset($description) ? $description : '' }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">
        <meta name="language" content="{{ $locale }}">

        <title>{{ str_replace('<br>', ',', $title) }} | HLS MST</title>

        <script src="{{ asset('js/app.js') }}" defer></script>

        <link rel="alternate" hreflang="x-default" href="@php echo url()->full() @endphp"/>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendors/fontawesome-pro/css/all.min.css') }}">

    </head>
    <body class="font-body">
    <div id="app" class="w-full bg-blend-darken ">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <x-layout.top/>
            <x-layout.header/>
            <div id="main" class="flex-grow">
                {{ $slot }}
            </div>
            <x-layout.footer/>
            <x-layout.bottom/>
        </div>
    </div>
    </body>
</html>
