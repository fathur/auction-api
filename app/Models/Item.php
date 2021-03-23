<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $casts = [
        'expiry_at' => 'datetime',
        'initial_price' => 'integer',
        'highest_bid_price' => 'integer',
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function itemUsers()
    {
        return $this->hasMany(ItemUser::class);
    }
}
