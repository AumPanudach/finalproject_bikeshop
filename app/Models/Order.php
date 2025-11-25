<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'order';

    protected $fillable = [
        'order_name',
        'order_email',
        'order_address',
        'order_phone',
        'serial_po',
        'user_id',
        'status',
    ];

    public function detail() {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
