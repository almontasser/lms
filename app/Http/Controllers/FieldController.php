<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function json_get(Request $request)
    {
        return Field::where('id', $request->input('id'))->get()->first();
    }

    public function json_search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        return Field::where('name', 'LIKE', "%{$searchTerm}%")->get();
    }

    public function json_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Field::create($request->only(['name']));

        return null;
    }
}
