<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;

class IngredientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy(Ingredient $ingredient)
    {
//        dd($ingredient);
        DB::table('ingredients')->where('id', '=', $ingredient->id)->delete();
        return back();
    }

    public function store(Request $request)
    {
        dd($request->input('food'));
        $food = DB::table('foods')->where('name', '=', $request->input('food'))->first();
//        dd(intval($request->input('count')));
        DB::table('ingredients')->insert([
            'user_id' => auth()->user()->id,
            'count' => intval($request->input('count')),
            'unit_of_measure' => $request->input('measure'),
            'food_id' => $food->id
        ]);
        return back();
    }


}
