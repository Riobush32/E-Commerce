<?php

namespace App\Livewire\Backend\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
    protected $queryString = ['perPage'];


    #[On('UpdateProductPhotoInList')]
    public function UpdateProductPhotoInList()
    {
        $this->resetPage();
    }
    #[On('updateProductList')]
    public function updateProductList()
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
    public function deleteProduct($id){
        $product = Product::find($id);
        if ($product) {
            $product->delete(); // Menghapus produk dari database
            session()->flash('message', 'Produk berhasil dihapus!');
        } else {
            session()->flash('message', 'Produk tidak ditemukan.');
        }
    }
    public function render()
    {
        return view('livewire.backend.product.product-list', [
            'products' => Product::where('name', 'like', '%' . $this->search . '%')->latest()
            ->paginate($this->perPage)
        ]);
    }
}
