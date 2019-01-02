<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        dd(DB::table('foods')->get());
//        dd(url('/users/1'));
        return view('user.show', [
            'user' => $user,
            'ingredients' => $user->ingredients(),
            'recipes' => $user->recipes(),
            'foods' => DB::table('foods')->get()
        ]);
    }
}
