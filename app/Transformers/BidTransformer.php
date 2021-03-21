<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Bid;

class BidTransformer extends TransformerAbstract
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
    public function transform(Bid $bid)
    {
        return [
            'id' => $bid->id,
            'nominal' => $bid->nominal,
            'username' => $bid->username
        ];
    }
}
