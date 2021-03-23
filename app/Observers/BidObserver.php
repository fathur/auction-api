<?php

namespace App\Observers;

use App\Models\Bid;
use App\Models\Preference;
use App\Models\ItemUser;
use App\Extensions\Bid as BidService;
use App\Jobs\AutoBid;

class BidObserver
{
    /**
     * Handle the Bid "created" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function created(Bid $bid)
    {
        \Log::info('observer created');
        self::setHighestBid($bid);

        $this->fillAutoBid($bid);
    }

    /**
     * Handle the Bid "updated" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function updated(Bid $bid)
    {
        
    }

    /**
     * Handle the Bid "deleted" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function deleted(Bid $bid)
    {
        //
    }

    /**
     * Handle the Bid "restored" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function restored(Bid $bid)
    {
        //
    }

    /**
     * Handle the Bid "force deleted" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function forceDeleted(Bid $bid)
    {
        //
    }

    public static function setHighestBid(Bid $bid)
    {
        $item = $bid->item;
        $item->highest_bidder_username = $bid->username;
        $item->highest_bid_price = $bid->nominal;
        $item->save();
    }

    public function fillAutoBid(Bid $bid)
    {
        AutoBid::dispatch(auth()->payload()->get('usr'), $bid);
    }
}
