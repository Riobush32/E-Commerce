<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan User sebagai penerima
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}