<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smm extends Model
{
    use HasFactory;

    protected $table = 'smms';

    protected $fillable = [
        'name',
        'code',
        'balance',
        'token',
        'tigia',
        'created_at',
        'updated_at',
        'domain',
        'status',
    ];

  

}
