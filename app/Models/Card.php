<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'username',
        'card_type',
        'card_amount',
        'card_code',
        'card_serial',
        'card_real_amount',
        'status',
        'note',
        'tranid',
        'promotion', 
        'discount',
        'domain',
        
    ];

     


}
