<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogRef extends Model
{
    use HasFactory;

    protected $table = 'log_refs';

    protected $fillable = [
        'username',
        'ref_id',
        'domain',
    ];
    public function referrer()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }
    


}
