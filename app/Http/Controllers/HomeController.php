<?php

namespace App\Http\Controllers;

use EasyRdf_Sparql_Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sparql = new EasyRdf_Sparql_Client('http://localhost:3030/food');

        $result = $sparql->query('SELECT ?p ?l WHERE { ?p rdfs:label ?l. }');
//        dd($result);
        $col = array();
        foreach ($result as $row){
            array_push($col, $row);
        }
        return view('layouts.app', [
            'foaf' => $col
        ]);
    }
}
