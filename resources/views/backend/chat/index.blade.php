<x-layouts-backend>
    <x-slot:active>{{ $active }}</x-slot:active>
    <div x-data="{ formAddCategory: false}" class="">
        @include('backend.components.breadcrumbs')
        @livewire('backend.chat.list-chat')
    </div>

</x-layouts-backend>
