<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title',
        'type',
        'issue_date',
        'file_path',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
