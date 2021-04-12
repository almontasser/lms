<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreatedMail;
use App\Mail\PasswordChangedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class UserController extends Controller
{
  private function sendAccountCreatedEmail(User $user, String $password)
  {
    Mail::to($user)->send(new AccountCreatedMail($user->name, $user->email, $password));
  }

  private function sendPasswordChangedEmail(User $user, String $password)
  {
    Mail::to($user)->send(new PasswordChangedMail($user->name, $user->email, $password));
  }

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
      'type' => 'required'
    ]);

    $password = randomPassword();

    $user = User::create([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'id_number' => $request->input('id_number'),
      'position' => $request->input('position'),
      'password' => Hash::make($password),
      'type' => $request->input('type')
    ]);

    $this->sendAccountCreatedEmail($user, $password);

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

  public function ChangePassword(User $user)
  {
    $password = randomPassword();

    $user->password = Hash::make($password);

    $this->sendPasswordChangedEmail($user, $password);

    return redirect()->route('users-list');
  }

  public function get(string $id)
  {
    return User::where('id_number', $id)->first();
  }

  public function get_import()
  {
    return view('users.import');
  }

  public function activate(User $user, Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email|unique:users,email,' . $user->id . '|confirmed|max:255'
    ]);

    $password = randomPassword();

    $user->email = $request->email;
    $user->password = Hash::make($password);
    $user->type = 2;
    $user->save();

    $this->sendAccountCreatedEmail($user, $password);

    return redirect()->route('users-list');
  }

  public function import(Request $request)
  {
    $this->validate($request, [
      'users_excel' => 'required|mimes:xlsx,xls'
    ]);

    $date = now();
    $extension = $request->users_excel->extension();
    $filename = date_format($date, 'Y-m-d-H-i-s') . '.' . $extension;
    $request->users_excel->storeAs('users', $filename);

    $reader = null;
    if ($extension == 'xls') {
      $reader = new Xls();
    } else if ($extension == 'xlsx') {
      $reader = new Xlsx();
    }

    $spreadsheet = $reader->load(storage_path('app/users/' . $filename));
    $imported_users = $spreadsheet->getSheet(0)->toArray();

    for ($i = 1; $i < count($imported_users); $i++) {
      // create user is it not in the database
      $user = User::firstOrCreate(
        ['id_number' => $imported_users[$i][1]],
        [
          'name' => $imported_users[$i][0],
          'position' => 'طالب',
          'type' => 4, // unregistered user
          'phone' => $imported_users[$i][11],
          'barcode' => $imported_users[$i][81]
        ]
      );

      $changed = false;
      // Update user details if changed
      if ($user->name != $imported_users[$i][0]) {
        $changed = true;
        $user->name = $imported_users[$i][0];
      }
      if ($user->barcode != $imported_users[$i][81]) {
        $changed = true;
        $user->barcode = $imported_users[$i][81];
      }

      if ($changed) {
        $user->save();
      }
    }

    return redirect()->route('users-list');
  }
}
