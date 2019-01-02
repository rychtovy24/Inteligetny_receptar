<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
