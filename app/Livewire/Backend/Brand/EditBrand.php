<?php

namespace App\Livewire\Backend\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\Attributes\On;

class EditBrand extends Component
{
    public $showEditBrand = false;
    public $idBrand, $name;

    #[On('toggleShowEditBrand')]
    public function toggleShowEditBrand($id){
        $this->showEditBrand = true;
        $this->idBrand = $id;
        $brand = Brand::find($id);
        $this->name = $brand->name;
    }

    public function updateBrandData(){
        // dd($this->name);
        $brand = Brand::find($this->idBrand);
        $brand->update([
            'name' => $this->name
        ]);
        $this->dispatch('updateBrandList');
        session()->flash('message', 'Brand berhasil disimpan!');
    }
    public function render()
    {
        return view('livewire.backend.brand.edit-brand');
    }
}