<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPhoto extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
}
