<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategorite;
use App\Models\Produkti;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    //

    public function gjejKategorine (Request $request){
        $kategoria=Produkti::with('category')->select('category_id')->where('furnitor_id',$request->furnitor_id)->groupBy('category_id')->get();
        return response()->json($kategoria);
    }

    public function gjejProduktin (Request $request){
        $produkti = Produkti::where('category_id', $request->category_id)->get();
        return response()->json($produkti);
    }
}
