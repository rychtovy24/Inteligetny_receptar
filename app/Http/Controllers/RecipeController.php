<?php

namespace App\Http\Controllers;

use function Couchbase\defaultDecoder;
use EasyRdf_Graph;
use EasyRdf_GraphStore;
use EasyRdf_Literal;
use EasyRdf_Sparql_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(string $recipeName)
    {
        $sparql = new EasyRdf_Sparql_Client('http://localhost:3030/food');

        $recipe = $sparql->query('SELECT ?uri ?name ?author WHERE { 
        ?uri rdfs:label ?name. 
        FILTER(?name="'.str_replace('_', ' ', $recipeName).'"@en). 
        ?uri <http://webprotege.stanford.edu/R70lHXU7IVm0MMHWVTEaRIs> ?author}');
        dd($recipe[0]->author);
        return view('welcome', [
            'title' => $recipe->name,
            'ingredients' => [],
            'descriptions' => [],
            'author' => $recipe[0]->author
        ]);
    }

    public function createRecipe()
    {
        return view('recipe.create', [
            'foods' => DB::table('foods')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $gs = new EasyRdf_GraphStore('http://localhost:3030/food/data');
        $graph1 = new EasyRdf_Graph();
        $recipe = str_replace(' ', '_', config('constant.recipeUri').$request->input('title'));
        $graph1->add($recipe, 'a', config('constant.RECIPE'));
        $graph1->add($recipe, 'a', config('constant.FOOD'));
        $graph1->add($recipe, 'rdfs:label', new EasyRdf_Literal($request->input('title'), 'en'));
        $graph1->add($recipe, config('constant.hasAnAuthor'), config('constant.userUri').auth()->user()->id);
        $ingredientList = $graph1->newBNode();
        $graph1->add($ingredientList, 'a', config('constant.INGREDIENT_LIST'));
        $graph1->add($recipe, config('constant.hasIngredientList'), $ingredientList);
        for ($i=1; ; $i++){
            $food = $request->input('food'.$i);
            if ($food == null){
                break;
            }
            $foodUri = DB::table('foods')->where('name', '=', $request->input('food'.$i))->first()->uri;
            $unit_of_measure = $request->input('measure'.$i);
            $count = $request->input('count'.$i);

            $ingredient = $graph1->newBNode();
            $graph1->add($ingredient, 'a', config('constant.INGREDIENT'));
            $graph1->add($ingredient, 'rdfs:label', new EasyRdf_Literal($food.' '.$count.' '.$unit_of_measure, 'en'));
            $graph1->add($ingredient, config('constant.hasFood'), $foodUri);

            $mass = $graph1->newBNode();
            $graph1->add($mass, 'a', config('constant.MASS'));
            $graph1->add($mass, config('constant.metric_quantity'), $unit_of_measure);
            $graph1->add($mass, config('constant.count'), doubleval($count));

            $graph1->add($ingredient, config('constant.hasQuantity'), $mass);
            $graph1->add($ingredientList, config('constant.hasIngredient'), $ingredient);
        }

        for ($i=1; ; $i++){
            $description_text = $request->input('step'.$i.'_description');
            if ($description_text == null){
                break;
            }
            $description = $graph1->newBNode();
            $graph1->add($description, 'a', config('constant.TEXT'));
            $graph1->add($description, 'rdfs:label', new EasyRdf_Literal($description_text, 'en'));

            $graph1->add($recipe, config('constant.hasDescription'), $description);
        }
//        dd($graph1);
        $gs->insertIntoDefault($graph1);
        return back();
    }
}
