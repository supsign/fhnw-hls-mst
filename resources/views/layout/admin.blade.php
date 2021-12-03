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

    @include('3rd-parties.smartlook')

    <title>{{ str_replace('<br>', ',', $title) }} | HLS MST Backend</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="alternate" hreflang="x-default" href="@php echo url()->full() @endphp"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/fontawesome-pro/css/all.min.css') }}">

</head>
<body class="font-body">
    <div id="app" class="w-full bg-gray-200 overflow-auto">
        <div class="flex flex-col h-screen relative">
            <x-admin.top/>
            <x-layout.header/>
            <div id="main" class="mb-4 mx-auto container mt-4 lg:flex">
                <div class="flex-none mx-2 sm:mb-4">
                    <x-admin.menu />
                </div>
                <div class="flex flex-col flex-grow lg:ml-4 mx-2">
                    {{ $slot }}
                </div>
            </div>
            <x-layout.footer/>
            <x-layout.bottom/>
        </div>
    </div>
</body>
</html>
