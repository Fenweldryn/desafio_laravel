<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles

    </head>
    <body class="font-sans antialiased">
        <div class="titler pt-5">
            <h2 class="text-white mb-3 ml-5">
                <img src="https://www.freepnglogos.com/uploads/netflix-logo-0.png" />                
            </h2>
        </div>
        @yield('content')
        
        @stack('modals')
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/slick.min.js') }}"></script>    
        <script src="{{ asset('js/flix.js') }}"></script>    
        @yield('js')
        @livewireScripts
    </body>
</html>