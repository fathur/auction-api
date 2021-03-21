<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Transformers\ItemTransformer;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->has('q')) {
            $q = strtolower($request->get('q'));
            $query = $query->where(function($query) use ($q) {
                $query->whereRaw("LOWER(name) LIKE '%{$q}%'")
                    ->orWhereRaw("LOWER(description) LIKE '%{$q}%'");
            }); 
        }

        if ($request->has('sort_dir')) {
            $query = $query->orderBy('highest_bid_price', $request->get('sort_dir'));
        }

        $items = $query->paginate(10);

        return response()->json(
            fractal($items, new ItemTransformer())->toArray()
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item, Request $request)
    {

        return response()->json(
            fractal($item, new ItemTransformer())->toArray()
        );
    }

   
}
