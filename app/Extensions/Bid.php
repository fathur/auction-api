<?php

namespace App\Extensions;

use Illuminate\Validation\ValidationException;
use App\Models\Bid as BidModel;
use App\Observers\BidObserver;

class Bid {

    public static function create($authUsername, $item, $nominal, $autoBid = true)
    {
        // $authUsername = auth()->payload()->get('usr');

        if ($item->expiry_at->lt(now())) {
            throw ValidationException::withMessages(['created_at' => 'Bid was closed.']);
        }

        // return $item->bids()->create([
            // 'nominal'   => $nominal,
            // 'username'  => $authUsername
        // ]);

        $bid = BidModel::where('item_id', $item->id)->first();
        $bid->nominal = $nominal;
        $bid->username = $authUsername;
        
        \Log::info('auto' . $autoBid);
        

        if ($autoBid) {
            \Log::info('save');

            $bid->save();
        } else {    
            \Log::info('saveQuietly');

            $bid->saveQuietly();

            BidObserver::setHighestBid($bid);
        }

        return $bid;

    }
}