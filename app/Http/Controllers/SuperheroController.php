<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Superhero;
use Illuminate\Http\Request;

class SuperheroController extends Controller
{

    public function index()
    {
        return Superhero::all()->except(['created_at', 'updated_at']);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'side' => 'required|in:Light,Dark',
            'hitpoints' => 'required|numeric',
            'attack' => 'required|numeric',
            'specialAbility' => 'max:255'
        ]);

        $superhero = new Superhero();

        $superhero->name = $request->name;
        $superhero->side = $request->side;
        $superhero->hitpoints = $request->hitpoints;
        $superhero->attack = $request->attack;
        $superhero->special_ability = $request->specialAbility;

        $superhero->save();

        return response()->json(
            [
                'success' => 'ok'
            ]
        );
    }

}
