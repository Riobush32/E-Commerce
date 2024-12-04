<!doctype html>
<html data-theme="mytheme" class="bg-slate-700">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    {{-- icon   --}}
    <link rel="stylesheet" href="{{ asset('icons/css/all.min.css') }}">
    {{-- alpine  --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<body class="min-h-[100vh] font-body scrollbar scrollbar-thumb-primary">

    <div class="px-16 mt-2 py-3 ">
        

        <div class="mt-20 px-3">
            <div class=" text-gray-300 p-5 rounded-xl">
                {{ $slot }}
            </div>

        </div>


    </div>

    {{-- copyright --}}
    <div class="w-full">
        <div class="fixed z-50 rotate-90 -translate-x-60 top-80">
            @include('page.admin.copyright')
        </div>
    </div>

</body>

</html>
