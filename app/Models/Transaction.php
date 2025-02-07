<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use App\Models\Summary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function summary(): BelongsTo{
        return $this->belongsTo(Summary::class);
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function cart(): BelongsTo{
        return $this->belongsTo(Cart::class);

    }

}