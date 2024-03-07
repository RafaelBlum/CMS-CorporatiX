<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'street'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
