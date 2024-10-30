<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">


    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-4" style="background: rgb(1, 129, 12)">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded-md mb-4" style="background: red">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}

            </main>
   
   <!-- Botón flotante -->
{{-- <div class="fixed bottom-4 right-4">
    <a href="{{ route('chat.index') }}" class="bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none">
        💬 Chat
    </a>
</div> --}}
   
</body>

</html>
{{-- <style>
    .fixed {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        /* Asegúrate de que esté por encima de otros elementos */
    }

    .bg-blue-500 {
        background-color: #3B82F6;
        /* Color de fondo */
    }

    .text-white {
        color: #FFFFFF;
        /* Color del texto */
    }

    .rounded-full {
        border-radius: 9999px;
        /* Hacer el botón circular */
    }

    .p-3 {
        padding: 12px;
        /* Espaciado interno */
    }

    .shadow-lg {
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        /* Sombra */
    }

    .hover\:bg-blue-600:hover {
        background-color: #2563EB;
        /* Color al pasar el mouse */
    }

    .transition {
        transition: background-color 0.3s;
        /* Transición suave */
    }
</style> --}}
