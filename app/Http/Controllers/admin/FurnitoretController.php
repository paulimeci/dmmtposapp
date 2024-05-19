<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Furnitoret;
use Illuminate\Http\Request;

class FurnitoretController extends Controller
{
    public function shtoFurnitor(){


        return view('admin.furnitoret.shto_furnitoret');
    } // End Method

    public function storeFurnitor(Request $request){

        Furnitoret::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'adresa' => $request->address,

        ]);

        $notification = array(
            'message' => 'Supplier Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('shiko.furnitor')->with($notification);

    } // End Method
    public function shikoFurnitor(){
        $furnitoret=Furnitoret::all();
        return view('admin.furnitoret.shiko_furnitoret',compact('furnitoret'));
    }

    public function editFurnitor($id){
        $furnitor = Furnitoret::findOrFail($id);
        return view('admin.furnitoret.edito_furnitoret',compact('furnitor'));

    }

    public function updateFurnitor(Request $request){


        Furnitoret::findOrFail($request->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'adresa' => $request->adresa,

        ]);

        $notification = array(
            'message' => 'Furnitori u perditesua me sukses',
            'alert-type' => 'success'
        );

        return redirect()->route('shiko.furnitor')->with($notification);
    }

    public function fshijFurnitor($id){

        Furnitoret::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Furnitori u fshi me sukses',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

}
