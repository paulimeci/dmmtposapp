<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blerjet;
use App\Models\Furnitoret;
use App\Models\Kategorite;
use App\Models\Njesia;
use App\Models\Produkti;
use Illuminate\Http\Request;

class BlerjetController extends Controller
{

    public function shikoBlerjet (){
        $blerjet=Blerjet::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('admin.blerjet.blerjet_all',compact('blerjet'));
    }
    public function shtoBlerje(){

        $furnitoret = Furnitoret::all();
        $njesia = Njesia::all();
        $kategoria = Kategorite::all();
        return view('admin.blerjet.bej_blerje',compact('furnitoret','njesia','kategoria'));

    } // End Method

    public function storeBlerje (Request $request){
        if($request->category_id==null){
            $notification = array(
                'message' => 'Sorry you do not select any item',
                'alert-type' => 'error'
            );
            return redirect()->back( )->with($notification);
        }else{
            $cat_tot=count($request->category_id);
            for($i=0; $i<$cat_tot; $i++){
                $blerjet=new Blerjet();
                $blerjet->furnitor_id=$request->furnitor_id[$i];
                $blerjet->nr_fature=$request->purchase_no[$i];
                $blerjet->kategori_id=$request->category_id[$i];
                $blerjet->produkt_id=$request->produkt_id[$i];
                $blerjet->sasia=$request->buying_qty[$i];
                $blerjet->cmimi_blerjes=$request->unit_price[$i];
                $blerjet->description=$request->description[$i];
                $blerjet->date= date('Y-m-d', strtotime($request->date[$i]));
                if($blerjet->save()){
                    $produkti=Produkti::where('id', $request->produkt_id[$i])->first();
                    $produkti->quantity=((float)($request->buying_qty[$i]))+((float)($produkti->quantity));
                    $produkti->save();
                }
            }

            $notification = array(
                'message' => 'Data Save Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('shiko.blerjet')->with($notification);
        } // End Method

    }

}
