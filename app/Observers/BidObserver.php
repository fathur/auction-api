<?php

namespace App\Observers;

use App\Models\Bid;

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
        //
    }

    /**
     * Handle the Bid "updated" event.
     *
     * @param  \App\Models\Bid  $bid
     * @return void
     */
    public function updated(Bid $bid)
    {
        //
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
}
