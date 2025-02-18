<?php

namespace App\Livewire\Backend\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Categorylist extends Component
{
    use WithPagination;

    public $categoryData = [] , $search, $perPage;

    public function mount(){
        $this->perPage = 5;
    }
    #[On('updateCategoryList')]
    public function updateCategoryList()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman pertama saat pencarian berubah
    }
    public function updatingPerPage()
    {
        $this->resetPage(); // Reset ke halaman pertama saat jumlah data berubah
    }
    public function deleteCategory($id){
        Category::find($id)->delete();
        $this->dispatch('updateCategoryList');
        session()->flash('message', 'Category berhasil dihapus!');
    }
    public function render()
    {
        return view('livewire.backend.category.category-list', [
            'categories' => Category::where('name', 'like', '%' . $this->search . '%')->latest()
            ->paginate($this->perPage)
        ]);
    }
}