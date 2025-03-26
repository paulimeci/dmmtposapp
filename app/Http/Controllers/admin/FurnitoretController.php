<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Furnitoret;
class FurnitoretController extends Controller
{

    public function shikoFurnitor(){
        $furnitoret=Furnitoret::all();
        return view('admin.furnitoret.shiko_furnitoret',compact('furnitoret'));
    }

}
