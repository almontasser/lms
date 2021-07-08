<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JanisKelemen\Setting\Facades\Setting;

class SettingsController extends Controller
{
  public function index()
  {
    return view('settings.index');
  }

  public function update(Request $request)
  {
    Setting::set("app_name", $request->app_name);
    Setting::set("address", $request->address);
    Setting::set("facebook_page", $request->facebook_page);
    if ($request->hasFile('app_logo')) {
      Setting::set("app_logo", 'uploads/' . $request->file("app_logo")->store("logos", "uploads"));
    }

    if (isset($request->username)) {
      User::create([
        'name' => $request->username,
        'email' => $request->useremail,
        'id_number' => $request->userid,
        'position' => 'المدير',
        'email_verified_at' => now(),
        'password' => Hash::make($request->userpassword),
        'type' => 5,
        'phone' => $request->userphone
      ]);

      Setting::set('settings_initiated', true);

      return redirect()->route('home');
    }

    return redirect()->back();
  }
}
