<?php

namespace App\Models;

use App\Models\Shipping;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Summary extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany {
        return $this->hasMany(Transaction::class);
    }

    public function shipping(): BelongsTo{
        return $this->belongsTo(Shipping::class);
    }
}