<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BidRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // throw new Exception("Error Processing Request", 1);
        
        // If throwing 404 not found add header X-Requested-With:XMLHttpRequest
        // https://stackoverflow.com/questions/33117664/why-is-my-create-form-request-throwing-off-a-404-exception-in-laravel5/33120181

        $item = $this->route('item');

        $minimumBid = $item->highest_bid_price + 1;

        return [
            'nominal' => ['required', 'integer', "min:{$minimumBid}"],
            
        ];
    }
}
