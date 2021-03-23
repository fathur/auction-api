<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominal', 'username', 'item_id'
    ];

    protected $casts = [
        'nominal' => 'integer'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    
}
