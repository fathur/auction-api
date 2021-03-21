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
    public function index()
    {
        $items = Item::paginate(10);

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
