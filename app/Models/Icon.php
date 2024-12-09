<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Icon extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories(): HasMany {
        return $this->hasMay(Category::class, 'icon_id');
    }
}
