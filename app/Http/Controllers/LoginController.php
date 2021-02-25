<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required'
    ]);

    /** @var User $user */
    $user = User::where('email', $request->input('email'))->first();

    if ($user->isInactive()) {
      return redirect()->route('login-inactive');
    }

    if ($user->isBanned()) {
      return redirect()->route('login-banned');
    }

    if (Auth::attempt($request->only(['email', 'password']), $request->input('remember'))) {
      return redirect()->route('home');
    } else {
      return redirect()->back();
    }
  }

  // logout
  public function destroy()
  {
    Auth::logout();
    return redirect()->route('home');
  }
}
