<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function json_get(Request $request)
    {
        return Specialty::where('id', $request->input('id'))->get()->first();
    }

    public function json_search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        return Specialty::where('name', 'LIKE', "%{$searchTerm}%")->get();
    }

    public function json_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Specialty::create($request->only(['name']));

        return null;
    }
}
