<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    return redirect()->back();
  }
}
