<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $table = 'withdraws';
    protected $fillable = [
        'user_id', 
        'amount', 
        'bank_name', 
        'account_number', 
        'account_name', 
        'status', 
        'domain',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
