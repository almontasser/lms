<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Database\QueryException;
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

        try {
            Field::create($request->only(['name']));
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json([
                    "success" => false,
                    "error" => "ااسم المجال الذي ادخلته موجود مسبقا"
                ]);
            }
        }

        return response()->json([
            "success" => true
        ]);
    }
}
