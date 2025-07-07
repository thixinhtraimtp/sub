<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProducCategories extends Model
{
    use HasFactory;

    protected $table = 'produc_categories';


    protected $fillable = [
        'name',
        'description',
        'note',
        'slug',
        'image',
        'code',
        'price',
        'domain'
    ];

    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
