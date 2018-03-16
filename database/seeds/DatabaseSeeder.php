<?php

use App\Core\Models\Category;
use Illuminate\Database\Seeder;
use App\Core\API\FetchCategories;
use App\Core\API\FetchJokes;
use App\User;
use App\Core\Models\Role;

class DatabaseSeeder extends Seeder
{
    private $fetchCategories;

    public function __construct(FetchCategories $fetchCategories, FetchJokes $fetchJokes) {
        $this->fetchCategories = $fetchCategories;
        $this->fetchJokes = $fetchJokes;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'superusuario'],
            ['name' => 'administrador'],
            ['name' => 'usuario'],
        ]);

        $superUserRole = Role::whereName('superusuario')->first();
        $userRole = Role::whereName('usuario')->first();

        $usuario = User::create([
            'id' => 1,
            'name' => 'System' ,
            'lastname' => 'System',
            'password' => bcrypt('secret'),
            'email' => 'system@mail.com',
            'username' => 'System',
        ]);

        $user = User::create([
            'id' => 2,
            'name' => 'interhanse' ,
            'lastname' => 'Administrador',
            'password' => bcrypt('secret'),
            'email' => 'interhanse@mail.com',
            'username' => 'interhanse',
        ]);

        $user->roles()->sync([$superUserRole->id]);
        

        $users = factory(App\User::class, 3)->create();

        $users->each(function($user) use ($userRole) {
            $user->roles()->sync([$userRole->id]);
        });

        $categories = $this->fetchCategories->all();

        Category::insert($categories->toArray());

        $jokes = $this->fetchJokes->get(env('JOKE_NUMBERS', 10));

        $jokes->each(function($joke) {
            $joke = App\Core\Models\Joke::create([
                'user_id' => 1,
                'icon_url'=> $joke->icon_url,
                'value' => $joke->value,
            ]);
    
            $persistedCategories = App\Core\Models\Category::all()->pluck('id', 'name');
            
            if (!is_null($joke->category)) {
                $jokeCategories=[];
                collect($joke->category)->each(function($category) use (&$jokeCategories, $persistedCategories) {
                    $jokeCategories[] = $persistedCategories[$category];
                });
                $joke->categories()->sync(jokeCategories);
            } else {
                $joke->categories()->sync([1, 2]);
            }
        });
    }
}
