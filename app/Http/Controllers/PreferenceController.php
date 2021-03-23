<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preference;
use App\Transformers\PreferenceTransformer;

class PreferenceController extends Controller
{
    protected $username;

    public function __construct()
    {
        $this->username = auth()->payload()->get('usr');
    }

    public function index()
    {

        $preferences = Preference::where('username', $this->username)
            ->get();

        return response()->json(
            fractal($preferences, new PreferenceTransformer)->toArray()
        );
    }

    public function update(Request $request, $id)
    {
        $preference = Preference::find($id);

        if (is_null($preference)) {
            $preference = new Preference();
            $preference->username = $this->username;
            $preference->key = 'budget';
        }

        $preference->value = $request->get('value');
        $preference->save();

        return response()->json(
            fractal($preference, new PreferenceTransformer)->toArray()
        );
    }
}
