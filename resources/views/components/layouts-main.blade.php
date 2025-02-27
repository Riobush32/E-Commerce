<!doctype html>
<html  data-theme="mytheme" class="bg-slate-100">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  {{-- icon   --}}
  <link rel="stylesheet" href="{{asset('icons/css/all.min.css')}}">


  @livewireStyles
</head>
<body class="font-body scrollbar scrollbar-thumb-primary">
  <div class="fixed z-50 bg-white top-0 w-full">
    <x-component-topbar></x-component-topbar>
    <livewire:component-navbar-search />
  </div>

  <div class="px-2 md:px-16 mt-2 pt-20 md:pt-24 ">
    {{$slot}}
  </div>
  <x-component-footer></x-component-footer>
  @livewireScripts
</body>
</html>
