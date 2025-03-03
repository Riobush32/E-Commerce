<?php

namespace App\Livewire\Backend\Product;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Variant;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use App\Models\ProductPhoto;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class DetailProduct extends Component
{
    use WithFileUploads;

    public $editing = false,
        $categories,
        $brands;
    public $name, $price, $categoryId, $brandId;
    public $idProduct;
    public $showDetailProduct = false;
    public $showVariantProduct = false;
    public $productImage;
    public $productDetailData = [],
        $editDescription = '',
        $editInfo = '';

    public $variantName, $variantWeight, $variantImage;
    #[On('setProductImage')]
    public function setProductImage($value)
    {
        // dd($value);
        $this->productImage = $value;
    }

    #[On('toggleDetailProduct')]
    public function toggleDetailProduct($id)
    {
        // dd($value);
        $this->idProduct = $id;
        $this->productDetailData = Product::find($id);
        $this->name = $this->productDetailData['name'];
        $this->price = $this->productDetailData['price'];
        $this->categoryId = $this->productDetailData['category']['id'];
        $this->brandId = $this->productDetailData['brand']['id'];
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->showDetailProduct = true;
        $this->editing = false;
        $this->dispatch('reloadJavaScript');
    }

    public function toogleEditing()
    {
        $this->editing = !$this->editing;
    }

    public function toogleVariantAdd()
    {
        $this->showVariantProduct = true;
        $this->dispatch('reloadScriptVariant');
    }
    public function mount()
    {
        $this->productDetailData = Product::find($this->idProduct);
    }
    public function updatedImage() {}
    public function updateProduct()
    {
        Product::find($this->idProduct)->update([
            'name' => $this->name,
            'price' => str_replace('.', '', $this->price),
            'category_id' => $this->categoryId,
            'brand_id' => $this->brandId,
        ]);
        // $this->editing = false;
        // $this->showDetailProduct = false;
        session()->flash('message', 'Produk berhasil diupdate!');
    }
    #[On('setEditDescription')]
    public function setEditDescription($value)
    {
        $this->editDescription = $value;
    }
    #[On('setEditInfo')]
    public function setEditInfo($value)
    {
        $this->editInfo = $value;
    }
    public function updateDescription()
    {
        // dd($this->editDescription);
        Product::find($this->idProduct)->update([
            'description' => $this->editDescription,
            'info' => $this->editInfo,
        ]);
    }
    public function deletePhotoProduct($id)
    {
        $productPhoto = ProductPhoto::find($id);
        $filePath = public_path($productPhoto->photo_patch);
        // Cek apakah file ada sebelum dihapus
        if (file_exists($filePath)) {
            File::delete($filePath); // Hapus file
            $productPhoto->delete(); // Hapus data dari database
            $this->dispatch('UpdateProductPhotoInList');
        } else {
            // Log jika file tidak ditemukan
            dd($filePath.'tidak ditemukan');
        }
    }

    public function decrementVariantStok($id)
    {
        $variant = Variant::find($id);
        $stok = $variant->stock;
        if ($stok > 0 && $stok != '') {
            $variant->update([
                'stock' => $stok - 1,
            ]);
            $this->allStok();
        }
    }
    public function incrementVariantStok($id)
    {
        $variant = Variant::find($id);
        $stok = $variant->stock;
        $variant->update([
            'stock' => $stok + 1,
        ]);
        $this->allStok();
    }
    public function allStok()
    {
        $variants = Variant::where('product_id', $this->idProduct)->get();
        $stokAll = $variants->sum('stock');
        Product::find($this->idProduct)->update([
            'stock' => $stokAll,
        ]);
    }
    public function deleteVariant($id)
    {
        $variantImage = Variant::find($id);
        $filePath = public_path($variantImage->variant_image);
        // Cek apakah file ada sebelum dihapus
        if (file_exists($filePath)) {
            File::delete($filePath); // Hapus file
            $variantImage->delete(); // Hapus data dari database
        } else {
            // Log jika file tidak ditemukan
            dd($filePath.'tidak ditemukan');
        }
    }
    public function saveImage()
    {
        // Pastikan ada file yang di-upload
        if ($this->productImage) {
            $filename = $this->productImage->getFilename();

            // Simpan informasi ke database
            ProductPhoto::create([
                'product_id' => $this->idProduct,
                'photo_patch' => 'uploads/livewire-tmp/' . $filename,
            ]);

            // Reset input file
            $this->productImage = null;
            $this->reset('productImage');
            $this->dispatch('UpdateProductPhotoInList');
            session()->flash('message', 'Produk Image berhasil disimpan!');
        }
    }

    public function saveVariant()
    {
        if ($this->idProduct != null || $this->variantName != null || $this->variantWeight != null || $this->variantImage != null) {
            $filename = $this->variantImage->getFilename();
            Variant::create([
                'product_id' => $this->idProduct,
                'name' => $this->variantName,
                'weight' => $this->variantWeight,
                'variant_image' => 'uploads/livewire-tmp/' . $filename,
            ]);

            // Reset input file
            $this->variantImage = null;
            $this->variantName = null;
            $this->variantWeight = null;
            $this->dispatch('UpdateProductPhotoInList');
            session()->flash('message', 'Produk Image berhasil disimpan!');
        }
    }

    public function render()
    {
        return view('livewire.backend.product.detail-product');
    }
}