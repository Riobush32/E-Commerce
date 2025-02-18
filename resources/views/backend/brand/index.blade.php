<x-layouts-backend>
    <x-slot:active>{{ $active }}</x-slot:active>
    <div x-data="{ formAddBrand: false}" class="">
        @include('backend.components.breadcrumbs')
        @livewire('backend.brand.brand-list')
        <div x-show="formAddBrand" class="fixed inset-0 flex items-center justify-center">
            @livewire('backend.brand.add-brand')
        </div>
        @livewire('backend.brand.edit-brand')

    </div>

</x-layouts-backend>
