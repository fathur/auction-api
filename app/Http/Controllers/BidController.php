<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Item;
use App\Transformers\BidTransformer;
use App\Http\Requests\BidRequest;
use Exception;
use Illuminate\Validation\ValidationException;
use App\Extensions\Bid as BidService;
use DB;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidRequest $request, Item $item)
    {
        $authUsername = auth()->payload()->get('usr');

        if ($authUsername == $item->highest_bidder_username) {
            throw ValidationException::withMessages(['username' => 'You already the highest bidder.']);
        }
        if ($item->expiry_at->lt(now())) {
            throw ValidationException::withMessages(['created_at' => 'Bid was closed.']);
        }

        DB::beginTransaction();

        $bid = $item->bids()->create([
            'nominal'   => $request->get('nominal'),
            'username'  => $authUsername
        ]);


        // $bid = BidService::create(
        //     $authUsername,
        //     $item,
        //     $request->get('nominal')
        // );

        $isAuto = $request->boolean('auto');

        if ($isAuto) {
            $item->itemUsers()->create([
                'username' => $authUsername,
                'auto_bid' => $isAuto
            ]);
        }

        DB::commit();

        return response()->json(
            fractal($bid, new BidTransformer())->toArray()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
