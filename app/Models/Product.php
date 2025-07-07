<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'data',
        'status',
        'user_buy_id',
        'image',
        'domain'
    ];

    public function category()
    {
        return $this->belongsTo(ProducCategories::class, 'category_id');
    }
}
