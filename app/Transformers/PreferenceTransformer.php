<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Preference;

class PreferenceTransformer extends TransformerAbstract
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
    public function transform(Preference $preference)
    {
        return [
            'id' => $preference->id,
            'username' => $preference->username,
            'key' => $preference->key,
            'value' => $preference->value,
        ];
    }
}
