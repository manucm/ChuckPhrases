<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index() {
        return view('layouts.login');
    }
    public function login(LoginRequest $request) {
        $auth = Auth::attempt([
            'username' => $request->get('username'),
            'password'=> $request->get('password'),
        ]);
        if (!$auth)
          return redirect('login')
                        ->withErrors('El usuario o contraseña no son correctos')
                        ->withInput();
          return redirect('/jokes');
    }
    public function logout() {
         Auth::logout();
         return redirect('login');
    }
}
