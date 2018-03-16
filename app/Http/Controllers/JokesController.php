<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Core\Models\Joke;
use App\Http\Requests\JokeRequest;

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
            'owner' => $user->username == self::SYSTEM_USERNAME? 'Propiedad de Chuck Norris' : "{$user->name} {$user->lastname}",
            'slug' => $joke->slug,
            'isVisited' => $joke->isVisited,
        ]);
    }

    public function markAsVisited(Request $request) {
        $slug = $request->get('slug');
        $isVisited = $request->get('isVisited');
        Joke::whereSlug($slug)->update([
            'isVisited' => $isVisited
        ]);
    }

    public function list() {
        return view('jokes.list');
    }

    public function listApi() {
        $jokeList = Joke::with('user')->get();

        return response()->json([
            'jokeList' => $jokeList,
            'count' => $jokeList->count()
        ]);
    }

    public function create(Joke $joke) {
        $action = (is_null($joke->id))? 'create' : 'update';

        $categories = \App\Core\Models\Category::all()->pluck('name', 'id');
        

        return view('jokes.form', compact('action', 'joke', 'categories'));
    }

    public function store(JokeRequest $request, Joke $joke)  {
        
        if(is_null($joke->id)) {
                $joke->icon_url = 'https://assets.chucknorris.host/img/avatar/chuck-norris.png';
                $joke->user_id= Auth::user()->id;
                $joke->value = $request->get('value');
            
            $joke->save();
        }  else {
            $joke->update([
                'value' => $request->get('value')
            ]);
        }

        $categories = $request->get('category_id'); 

        $joke->categories()->sync($categories);

        return redirect('/jokes');
    }
}
