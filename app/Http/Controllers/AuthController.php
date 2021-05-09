<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

  
    public function __construct()
    {
      $this->middleware('guest', ['except' => 'logout']);
      $this->middleware('auth', ['only' => 'logout']);
    }
  

  public function getRegisterForm()
  {
    return view('auth.register');
  }

  public function register(RegisterRequest $request)
  {
    $data = $request->validated();
    $data['password'] = Hash::make($data['password']);
    $newUser = User::create($data);

    Auth::login($newUser);
    return redirect('/');
  }

  public function logout()
  {
    Auth::logout();
    return back();
  }

  public function getLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $credentials = [
      'email' => $request->input('email'),
      'password' => $request->input('password')
    ];

    if (Auth::attempt($credentials)) {
      return redirect('/');
    }

    return view('auth.login', ['invalid_credentials' => true]);
  }
}