<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'status',
        'note',
        'data',
        'domain'
    ];

    public function product()
    {
        return $this->belongsTo(ProducCategories::class, 'product_id');
    }
}
