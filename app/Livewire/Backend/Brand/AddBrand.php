<?php

namespace App\Livewire\Backend\Brand;

use App\Models\Brand;
use Livewire\Component;

class AddBrand extends Component
{
    public $name;

    public function saveNewBrand(){
        Brand::create([
            'name' => $this->name
        ]);
        $this->dispatch('updateBrandList');
        session()->flash('message', 'Brand berhasil disimpan!');
    }
    public function render()
    {
        return view('livewire.backend.brand.add-brand');
    }
}