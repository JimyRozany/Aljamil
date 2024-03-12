<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone_1',
        'phone_2',
        'address',
        'city',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "id");
    }
    public function orderItems()
    {

        return $this->hasMany(OrderItem::class);
    }
}
