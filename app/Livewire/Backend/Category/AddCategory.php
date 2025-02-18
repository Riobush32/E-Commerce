<?php

namespace App\Livewire\Backend\Category;

use App\Models\Icon;
use Livewire\Component;
use App\Models\Category;

class AddCategory extends Component
{
    public $name, $icons, $iconId;

    public function mount(){
        $this->icons = Icon::all();
    }

    public function saveNewCategory(){
        // dd($this->iconId);
        Category::create([
            'name' => $this->name,
            'icon_id' => $this->iconId
        ]);
        $this->dispatch('updateCategoryList');
        session()->flash('message', 'Category berhasil disimpan!');
    }
    public function render()
    {
        return view('livewire.backend.category.add-category');
    }
}