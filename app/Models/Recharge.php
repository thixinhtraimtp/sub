<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_code',
        'payment_method',
        'bank_name',
        'bank_code',
        'amount',
        'real_amount',
        'status',
        'note',
        'domain',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
