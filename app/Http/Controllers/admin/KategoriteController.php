<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategorite;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KategoriteController extends Controller
{
    //
    public function shtoKategori(){
        $kategorite=Kategorite::all();
        return view('admin.kategorite.shto_kategori',compact('kategorite'));
    }

    public function storeKategori (Request $request){
        $kategoria_re = new Kategorite();
        $kategoria_re->name=$request->name;
        $kategoria_re->parent_id=$request->parent_id;
        $kategoria_re->save();
        return redirect()->back();
    }

    public function shikoKategori(){
        $kategorite=Kategorite::all();
        return view('admin.kategorite.shiko_kategori',compact('kategorite'));
    }

    public function fshijKategori ($id){
        $del_kategori=Kategorite::findOrFail($id);
        $del_kategori->delete();
        $notification = array(
            'message' => 'Procesi u fshi me sukses',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function editKategori($id){
        $kategorite=Kategorite::findOrFail($id);
        $kategorite_list=Kategorite::where('id', '!=', $id)->latest()->get();
        return view('admin.kategorite.edit_kategori',compact('kategorite','kategorite_list'));
    }

    public function updateKategori(Request $request){
        Kategorite::findOrFail($request->id)->update([
            'name'=>$request->emri,
            'parent_id'=>$request->parent_id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'U perditesua me sukses',
            'alert-type' => 'success'
        );
        return redirect()->route('shiko.kategori')->with($notification);
    }

}
