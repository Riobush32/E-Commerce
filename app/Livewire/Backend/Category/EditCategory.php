<?php

namespace App\Livewire\Backend\Category;

use App\Models\Icon;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;

class EditCategory extends Component
{
    public $showEditCategory = false;
    public $idCategory, $icons, $iconId, $name;

    #[On('toggleShowEditCategory')]
    public function toggleShowEditCategory($id){
        $this->showEditCategory = true;
        $this->idCategory = $id;
        $Category = Category::find($id);
        $this->name = $Category->name;
        $this->iconId = Category::find($id)->icon_id;

    }

    public function mount(){
        $this->icons = Icon::all();
    }

    public function updateCategoryData(){
        // dd($this->name);
        $Category = Category::find($this->idCategory);
        $Category->update([
            'name' => $this->name,
            'icon_id' => $this->iconId,
        ]);
        $this->dispatch('updateCategoryList');
        session()->flash('message', 'Category berhasil disimpan!');
    }
    public function render()
    {
        return view('livewire.backend.Category.edit-Category');
    }
}