<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Models\Joke;

class JokesController extends Controller
{
    public function random() {
        return view('jokes.random');
    }

    public function randomApi() {
        return response()->json([
            'status' => 'OK',
            'Joke' => Joke::orderByRandom()->limit(1)->first(),
        ]);
    }
}
