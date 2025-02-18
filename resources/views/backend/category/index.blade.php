<x-layouts-backend>
    <x-slot:active>{{ $active }}</x-slot:active>
    <div x-data="{ formAddCategory: false}" class="">
        @include('backend.components.breadcrumbs')
        @livewire('backend.category.category-list')
        <div x-show="formAddCategory" class="fixed inset-0 flex items-center justify-center">
            @livewire('backend.category.add-category')
        </div>
        @livewire('backend.category.edit-category')

    </div>

</x-layouts-backend>
