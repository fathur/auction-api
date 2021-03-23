<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;


class ItemUser extends Model
{
    protected $fillable = ['item_id', 'username', 'auto_bid'];

    protected $table = 'items_users';

    protected $casts = [
        'auto_bid' => 'bool',
        'item_id' => 'int'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
