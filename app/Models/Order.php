<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'client_id',
        'lastname',
        'address',
        'cart'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
