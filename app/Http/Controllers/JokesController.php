<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Models\Joke;

class JokesController extends Controller
{
    const SYSTEM_USERNAME = 'System';

    public function random() {
        return view('jokes.random');
    }

    public function randomApi() {
        $joke = Joke::with('user')
                    ->orderByRandom()->limit(1)->first();
        
        $user = $joke->user;
        
        return response()->json([
            'status' => 'OK',
            'joke' => $joke->value,
            'joke_image' => $joke->icon_url,
            'owner' => $user->username == self::SYSTEM_USERNAME? 'Propiedad de Chuck Norris' : "{$user->name} {$user->lastname}"
        ]);
    }
}
