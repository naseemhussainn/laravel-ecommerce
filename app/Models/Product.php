<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image',
        'attributes',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
