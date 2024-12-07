<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'order_number',
        'total_amount',
        'status',
        'placed_at'
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

}
