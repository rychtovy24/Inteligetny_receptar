<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            'user_name' => 'matej24',
            'email' => 'test@test.sk',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm' // secret
        ));
        DB::table('users')->insert(array(
            'user_name' => 'julka01',
            'email' => 'test2@test.sk',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm' // secret
        ));

        $sparql = new EasyRdf_Sparql_Client('http://localhost:3030/food');

        $result = $sparql->query('SELECT ?uri ?name WHERE { ?uri a <'.config('constant.FOOD').'>. ?uri rdfs:label ?name. }');
//        dd($result);
        foreach ($result as $row){
            DB::table('foods')->insert(array(
                'uri' => $row->uri,
                'name' => $row->name
            ));
        }
        $measure = config('constant.measure');
        for ($i = 0; $i < 15; $i++){
            DB::table('ingredients')->insert(array(
                'user_id' => 1,
                'food_id' => \App\Food::all()->random(1)->first()->id,
                'count' => random_int(100,1000),
                'unit_of_measure' => $measure[array_rand($measure)]
            ));
        }
        for ($i = 0; $i < 15; $i++){
            DB::table('ingredients')->insert(array(
                'user_id' => 2,
                'food_id' => \App\Food::all()->random(1)->first()->id,
                'count' => random_int(100,1000),
                'unit_of_measure' => $measure[array_rand($measure)]
            ));
        }
    }
}
