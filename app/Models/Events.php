<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'categoryId',
        'spots',
        'activation',
        'organizerId',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizerId');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
