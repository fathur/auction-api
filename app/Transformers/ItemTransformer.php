<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Item;

class ItemTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Item $item)
    {
        return [
            'id' => $item->id,
            'name'  => $item->name,
            'description'  => $item->description,
            'expiry_at'  => $item->expiry_at->timestamp,
            'image_url'  => $item->image_url,
            'initial_price' => $item->initial_price,
            'highest_price' => $item->highest_bid_price,
            'highest_bidder' => $item->highest_bidder_username
        ];
    }
}
