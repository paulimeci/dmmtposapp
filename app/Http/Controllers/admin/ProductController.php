<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Furnitoret;
use App\Models\Kategorite;
use App\Models\Njesia;
use App\Models\ProductQP;
use App\Models\Produkti;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    //

    public function shtoProdukt(){

        $kategoria = Kategorite::all();
        $njesia = Njesia::all();
        $furnitori = Furnitoret::all();
        return view('admin.produktet.shto_produkt',compact('kategoria','njesia','furnitori'));
    } // End Method

    public function productStore(Request $request){

        $product_add=new Produkti();
        $product_add->name=$request->name;
        $product_add->njesia_id=$request->unit_id;
        $product_add->category_id=$request->category_id;
        $product_add->furnitor_id=$request->furnitori_id;
        $product_add->quantity=$request->sasia_produktit;

        $product_add->save();

        $pro_qp=new ProductQP();
        $pro_qp->product_id=$product_add->id;
        $pro_qp->cmimi_blerjes=$request->cmimi_blerjes;
        $pro_qp->price=$request->cmimi_produktit;
        $pro_qp->save();

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }

    public function shikoProduktet (){
        $produktet=Produkti::all();
        return view('admin.produktet.shiko_produktet',compact('produktet'));
    }

    public function editProdukt ($id){
        $kategorite=Kategorite::all();
        $njesia=Njesia::all();
        $produkti=Produkti::findOrFail($id);
        return view('admin.produktet.edito_produktin',compact('kategorite', 'njesia', 'produkti'));
    }

    public function fshijProdukt($id){
        Produkti::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function perditesoProduktin(Request $request){
        Produkti::findOrFail($request->id)->update([

            'name' => $request->name,
            'njesia_id' => $request->unit_id,
            'furnitor_id' => $request->furnitori_id,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );
        $perditsimi2= ProductQP::where('product_id', $request->id)->first();
        $perditsimi2->price=$request->cmimi;
        $perditsimi2->cmimi_blerjes=$request->cmimi_blerjes;
        $perditsimi2->save();
        return redirect()->route('shiko.produktet')->with($notification);
    }

    public function editoCmimet(Request $request) {
        $kategorite = Kategorite::all();
        $selected_category_id = $request->input('category_id'); // Get the selected category ID from the request
        if ($selected_category_id) {
            $produktet = Produkti::whereHas('category', function($query) use ($selected_category_id) {
                $query->where('id', $selected_category_id);
            })->get();
        } else {
            $produktet = Produkti::all();
        }
        return view('admin.produktet.edito_cmimet', compact('produktet', 'kategorite'));
    }

   public function perditesoCmimin (Request $request){
        //dd($request->all());
        $produkti=Produkti::findOrFail($request->id);
        $produkti->quantity=$request->quantity;
        $produkti->name=$request->emri;
        $produkti->save();

        $prodqp = ProductQP::where('product_id', $request->id)->first();
        $prodqp->price=$request->price;
        $prodqp->save();

        return redirect()->back();
    }
}
