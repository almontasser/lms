<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function index()
  {
    return view('auth.register');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|max:255',
      'email' => 'required|email|unique:users,email|max:255',
      'phone' => 'required|unique:users,phone|max:255',
      'id_number' => 'required|unique:users,id_number|max:30',
      'position' => 'required|max:255',
      'password' => 'required|min:8|confirmed',
    ]);

    User::create([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'id_number' => $request->input('id_number'),
      'position' => $request->input('position'),
      'password' => Hash::make($request->input('password')),
      'type' => 0
    ]);

    return redirect()->route('register-success');
  }

  public function registerSuccess()
  {
    return view('auth.register-success');
  }
}
