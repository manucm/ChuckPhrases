<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/prueba', function () {
     //$fetch = new App\Core\API\Fetch('https://api.chucknorris.io/jokes/search?query=joke');
     $fecthCategory = new App\Core\API\FetchJokes();
     $jokes = $fecthCategory->get(10);

     $jokes->each(function($joke) {var_dump($joke);
        $joke = App\Core\Models\Joke::create([
            'user_id' => 1,
            'icon_url'=> $joke->icon_url,
            'value' => $joke->value,
            'slug' => '',
        ]);

        $persistedCategories = App\Core\Models\Category::all()->pluck('id', 'name');
        //var_dump($persistedCategories);
        if (!is_null($joke->category)) {
            $jokeCategories=[];
            collect($joke->category)->each(function($category) use (&$jokeCategories, $persistedCategories) {
                $jokeCategories[] = $persistedCategories[$category];
            });
            var_dump('asdf');
            $joke->categories()->sync(jokeCategories);
        } else {
            $joke->categories()->sync([1, 2]);
        }
    });


});

Route::get('/pruebas', function() {dd(Auth::user()->id);
    dd(App\Core\Models\Joke::orderByRandom()->limit(1)->toSql());
});

//####

//Login
Route::get('/login', ['uses' => 'LoginController@index']);
Route::post('/login', ['uses' => 'LoginController@login']);
Route::get('/logout', ['uses' => 'LoginController@logout']);

//Jokes
Route::get('/', ['uses' => 'JokesController@random']);

Route::get('/jokes', ['uses' => 'JokesController@list']);

Route::get('/jokes/create', ['uses' => 'JokesController@create']);

Route::get('/jokes/{slug}', ['uses' => 'JokesController@create']);


Route::post('/jokes/create', ['uses' => 'JokesController@store']);
Route::put('/jokes/{slug}', ['uses' => 'JokesController@store']);