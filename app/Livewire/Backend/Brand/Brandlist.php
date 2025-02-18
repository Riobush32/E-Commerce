<?php

namespace App\Livewire\Backend\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Brandlist extends Component
{
    use WithPagination;

    public $brandData = [] , $search, $perPage;

    public function mount(){
        $this->perPage = 5;
    }
    #[On('updateBrandList')]
    public function updateBrandList()
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
    public function deleteBrand($id){
        Brand::find($id)->delete();
        $this->dispatch('updateBrandList');
        session()->flash('message', 'Brand berhasil dihapus!');
    }
    public function render()
    {
        return view('livewire.backend.brand.brandlist', [
            'brands' => Brand::where('name', 'like', '%' . $this->search . '%')->latest()
            ->paginate($this->perPage)
        ]);
    }
}