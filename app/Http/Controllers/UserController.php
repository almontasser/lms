<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index()
  {
    return view('users.index');
  }

  public function registrations()
  {
    return view('users.registrations', [
      'users' => User::where('type', 0)->get()
    ]);
  }

  public function list()
  {
    return view('users.list', [
      'users' => User::where('type', '!=', 0)->get(),
    ]);
  }

  public function accept_reject(User $user, Request $request)
  {
    $this->validate($request, [
      'action' => 'required'
    ]);

    if ($request->input('action') == 'accept') {
      $user->type = 2;
      $user->save();
    } else if ($request->input('action') == 'reject') {
      $user->delete();
    }

    return redirect()->back();
  }

  public function create()
  {
    return view('users.edit', [
      'edit' => false,
      'user' => null
    ]);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|min:3|max:255',
      'email' => 'required|email|unique:users,email|max:255',
      'phone' => 'required|unique:users,phone',
      'id_number' => 'required|unique:users,id_number|max:30',
      'position' => 'required|max:255',
      'password' => 'required|min:8|confirmed',
      'type' => 'required'
    ]);

    User::create([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'id_number' => $request->input('id_number'),
      'position' => $request->input('position'),
      'password' => Hash::make($request->input('password')),
      'type' => $request->input('type')
    ]);

    return redirect()->route('users-list');
  }

  public function edit(User $user)
  {
    return view('users.edit', [
      'edit' => true,
      'user' => $user
    ]);
  }

  public function update(User $user, Request $request)
  {
    $this->validate($request, [
      'name' => 'required|min:3|max:255',
      'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
      'phone' => 'required|unique:users,phone,' . $user->id,
      'id_number' => 'required|unique:users,id_number,' . $user->id . '|max:30',
      'position' => 'required|max:255',
      'password' => $request->password != null ? 'sometimes|min:8|confirmed' : '',
      'type' => 'required'
    ]);

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->id_number = $request->input('id_number');
    $user->position = $request->input('position');
    $user->type = $request->input('type');
    if ($request->input('password')) {
      $user->password = Hash::make($request->input('password'));
    }
    $user->save();

    return redirect()->route('users-list');
  }

  public function get(string $id)
  {
    return User::where('id_number', $id)->first();
  }
}
