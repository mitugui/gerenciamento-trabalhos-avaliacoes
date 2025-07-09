<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SGTA') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-green-900 antialiased bg-green-100">

    <div class="min-h-screen flex">
        <div class="w-3/5 bg-green-800 text-white flex flex-col justify-center items-center p-12">
            <h1 class="text-7xl font-bold mb-6 fade-in">Bem-vindo ao SGTA</h1>
            <p class="text-lg font-bold fade-in delay-500 text-center max-w-lg">
                Sistema de Gerenciamento de Trabalhos Acadêmicos.<br>
                Aqui você pode inscrever trabalhos e acompanhar avaliações.
            </p>
        </div>

        <div class="w-2/5 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                @isset($header)
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-semibold">{{ $header }}</h2>
                    </div>
                @endisset
                <div class="bg-white shadow-md rounded-lg px-6 py-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
