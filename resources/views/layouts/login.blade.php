@props(['title' => null])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">

<head>
    <base href="">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
          content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="./images/favicon.png">
    <title>{{ $title ?? config('app.name') }} | Vinco</title>
    @vite(['resources/css/backend/backend.css'])
    @stack('styles')
</head>

<body class="nk-body bg-lighter npc-default pg-auth">
<div class="nk-app-root">
    <div class="nk-main ">
        <div class="nk-wrap nk-wrap-nosidebar">
            <div class="nk-content ">
                <div class="nk-split nk-split-page nk-split-md">
                    {{ $slot }}
                    <div class="nk-split-content nk-split-stretch bg-abstract"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/bundle.js') }}"></script>
<script src="{{ asset("js/scripts.js") }}"></script>
@stack('scripts')
</body>
</html>
