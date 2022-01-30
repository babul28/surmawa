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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @livewireScripts

    {{ $scripts ?? '' }}

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col">

        <!-- Page Heading -->
        <header>
            @include('layouts.navigation')

            {{-- <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div> --}}
        </header>

        <!-- Page Content -->
        <main class="flex-grow flex-shrink">
            {{ $slot }}
        </main>

        <footer class="text-sm p-4">
            <p class="m-0 text-center">Build with &#10084;. {{ now()->format('Y') }} all rights reserved.</p>
        </footer>

        @unless(App::environment('production'))
        <x-utils.viewport />
        @endunless

    </div>

</body>

</html>
