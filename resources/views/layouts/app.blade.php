<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased  bg-gray-50 dark:bg-gray-900">
    <x-navbar-navigation />
    <div class="min-h-screen bg-gray-100">
        <x-sidebar-navigation />
        <!-- Page Heading -->
        <main class="p-4 md:ml-64 h-auto pt-20">
            @isset($header)
                <header class="bg-transparent rounded-lg">
                    <div class="max-w-full py-6 px-4 sm:px-6 lg:px-8">
                        <x-auto-breadcrumb />
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <div class="max-w-full px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
