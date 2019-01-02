<?php

namespace App;

use EasyRdf_Sparql_Client;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class)->get();
    }

    public function recipes()
    {
        $sparql = new EasyRdf_Sparql_Client('http://localhost:3030/food');

        $result = $sparql->query('SELECT ?uri ?name WHERE { ?uri <'.config('constant.hasAnAuthor').'> <'.config('constant.userUri').$this->id.'>.'.
                                                        '?uri rdfs:label ?name. FILTER(lang(?name)=\'en\'). }');
//        dd($result);
        $col = array();
        foreach ($result as $row){
            array_push($col, $row);
        }
        return $col;
    }
}
