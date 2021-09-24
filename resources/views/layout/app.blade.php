<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
