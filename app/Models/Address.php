<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'user_id'];

    protected $fillable = [
        'street',
        'number',
        'bairro',
        'city',
        'state',
        'cep'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}