<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ItemUser;
use App\Models\Bid;
use App\Models\Preference;
use App\Extensions\Bid as BidService;

class AutoBid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bid;

    protected $user;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, Bid $bid)
    {
        $this->bid = $bid;

        $this->user = $user;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       

        $itemsUsers = ItemUser::where([
            'item_id' => $this->bid->item_id,
            'auto_bid' => true
        ])->get();

        foreach($itemsUsers as $itemUser) {

            $budget = Preference::where([
                'username' => $itemUser->username,
                'key' => 'budget'
            ])->first();

            $currentBudget = $budget ? $budget->value : 0;

            if ($currentBudget > $itemUser->item->highest_bid_price and $itemUser->username != $this->user) {

                $increment = 1;

                BidService::create(
                    $itemUser->username, 
                    $itemUser->item, 
                    $itemUser->item->highest_bid_price + $increment,
                    false // prevent auto bid
                );

                Preference::where([
                    'username' => $itemUser->username,
                    'key' => 'budget'
                ])->update([
                    'value' => $currentBudget - ($itemUser->item->highest_bid_price + $increment)
                ]);
            }
        }
    }
}
