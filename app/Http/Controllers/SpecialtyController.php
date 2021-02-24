<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Database\QueryException;
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

        try {
            Specialty::create($request->only(['name']));
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json([
                    "success" => false,
                    "error" => "ااسم التخصص الذي ادخلته موجود مسبقا"
                ]);
            }
        }

        return response()->json([
            "success" => true
        ]);
    }
}
