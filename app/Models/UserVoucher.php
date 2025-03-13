<?php

namespace App\Models;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserVoucher extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }
}
