<!doctype html>
<html  data-theme="mytheme">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  {{-- icon   --}}
  <link rel="stylesheet" href="{{asset('icons/css/all.min.css')}}">
  {{-- alpine  --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @livewireStyles
</head>
<body class="font-body scrollbar scrollbar-thumb-primary">
  <div class="fixed z-50 bg-white top-0 w-full">
    <x-component-topbar></x-component-topbar>
    <livewire:component-navbar-search />
  </div>

  <div class="px-16 mt-2 pt-24 ">
    {{$slot}}
  </div>
  <x-component-footer></x-component-footer>
  @livewireScripts
</body>
</html>
