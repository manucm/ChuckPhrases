<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class VisitedJoke extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitedJoke {--u=} {--p=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $user;

    protected $pass;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->option('u');
        $pass = $this->option('p');

        if ($this->login($user, $pass)) {
            $headers = ['id', 'Value'];
            $visitedJoked = \App\Core\Models\Joke::where('isVisited', 1)->select('id', 'value')->get();

           $this->table($headers, $visitedJoked);
        } else {
            dd('no tiene permisos');
        }
    }

    private function login($user, $pass) {
        $user =  \App\User::where('username', $user)
                    ->first();

        if (!$user)
            return false;

        return Hash::check($pass, $user->password);
    }
}
