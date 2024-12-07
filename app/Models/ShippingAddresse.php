<?php

namespace App\Models;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddresse extends Model {
    use HasFactory;

    // Table associated with the model
    protected $table = 'shipping_addresses';
    protected $fillable = array('user_id', 'address_line_1', 'address_line_2', 'city', 'state', 'postal_code', 'country');

  

    /**
     * Relationship with the User model.
     */
    public function user() {
        return $this->belongsTo( User::class );
    }

    /**
     * Relationship with the Order model.
     */
    public function orders() {
        return $this->hasMany( Order::class, 'shipping_address_id' );
    }
}
