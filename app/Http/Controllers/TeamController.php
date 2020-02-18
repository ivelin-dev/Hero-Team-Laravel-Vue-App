<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{

    public function index()
    {
        return Team::with('heroes')->get();
    }

    public function store(Request $request)
    {


        $requestData = $request->json()->all();

        $validator = Validator::make($requestData, [
            'teamName' => 'required|max:255',
            'side' => 'required|in:light,dark',
            'heroIds' => 'required|array|between:3,5'
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'errors' => $validator->errors()->all()
                ]
            );
        }

        $team = new Team();
        $team->name = $requestData['teamName'];
        $team->side = $requestData['side'];

        $team->save();

        $heroIds = $requestData['heroIds'];

        $team->heroes()->attach($heroIds);


        return response()->json(
            [
                'success' => 'ok'
            ]
        );
    }

}
