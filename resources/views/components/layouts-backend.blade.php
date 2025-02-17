<!doctype html>
<html data-theme="mytheme" class="bg-slate-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    {{-- icon   --}}
    <link rel="stylesheet" href="{{ asset('icons/css/all.min.css') }}">
    {{-- alpine  --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- editor --}}
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    @livewireStyles
</head>

<body class="font-body scrollbar scrollbar-thumb-primary h-[100vh] ">
    <div class="fixed top-0 w-full z-[9999]">
        @include('backend.components.navbar')
    </div>
    <div class="mt-28 w-full flex items-center justify-center px-20">
        <div class="w-full">
            {{ $slot }}
        </div>
    </div>

    <div class="fixed z-[9999] bottom-8 left-1/2 transform -translate-x-1/2 -translate-y-1/2 ">
        @include('backend.components.navigator')
    </div>




    @livewireScripts
</body>

</html>
