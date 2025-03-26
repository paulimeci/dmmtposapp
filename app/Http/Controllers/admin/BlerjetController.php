<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blerjet;
use App\Models\Furnitoret;
use App\Models\Kategorite;
use App\Models\NdryshimiCmimitLogs;
use App\Models\Njesia;
use App\Models\ProductQP;
use App\Models\Produkti;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class BlerjetController extends Controller
{

    public function shikoBlerjet()
    {

        return view('admin.blerjet.blerjet_all');
    }

    public function shkarkoFaturen ($id){
        $lista_blerjes=Blerjet::where('nr_fature',$id)->get();
        $pdf = Pdf::loadView('admin.blerjet.shkarko_faturen', compact('lista_blerjes'))
            ->setPaper('A4', 'portrait')
            ->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream($id .'.pdf');


    }
    public function shtoBlerje(){

        $furnitoret = Furnitoret::all();
        $njesia = Njesia::all();
        $kategoria = Kategorite::all();
        return view('admin.blerjet.bej_blerje',compact('furnitoret','njesia','kategoria'));

    } // End Method

    public function storeBlerje(Request $request)
    {
        if ($request->category_id == null) {
            $notification = [
                'message' => 'Sorry, you did not select any item',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        // Start database transaction
        DB::beginTransaction();

        try {
            $cat_tot = count($request->category_id);

            for ($i = 0; $i < $cat_tot; $i++) {
                // Create new purchase record
                $blerjet = new Blerjet();
                $blerjet->furnitor_id = $request->furnitor_id[$i];
                $blerjet->nr_fature = $request->purchase_no[$i];
                $blerjet->kategori_id = $request->category_id[$i];
                $blerjet->produkt_id = $request->produkt_id[$i];
                $blerjet->sasia = $request->buying_qty[$i];
                $blerjet->cmimi_blerjes = $request->unit_price[$i];
                $blerjet->date = date('Y-m-d', strtotime($request->date[$i]));
                $blerjet->save();

                // Update the product's quantity and average price
                $produkti = Produkti::where('id', $request->produkt_id[$i])->first();
                $produkti_qp = ProductQP::where('product_id', $request->produkt_id[$i])->first();

                $current_quantity = $produkti->quantity; // Current quantity in stock
                $current_price = $produkti_qp->cmimi_blerjes; // Current average price

                $new_quantity = $request->buying_qty[$i]; // New quantity purchased
                $new_price = $request->unit_price[$i]; // New unit price

                // Calculate the new average price
                $total_cost = ($current_quantity * $current_price) + ($new_quantity * $new_price);
                $total_quantity = $current_quantity + $new_quantity;

                if($new_price != $current_price){
                    NdryshimiCmimitLogs::create([
                        'fatura_id'=>$blerjet->nr_fature,
                        'product_id'=>$blerjet->produkt_id,
                        'sasia_vjeter'=>$current_quantity,
                        'cmimi_vjeter'=>$current_price,
                    ]);
                }

                // Update product's quantity and average purchase price
                $produkti->quantity = $total_quantity;
                if ($total_quantity > 0) {
                    $produkti_qp->cmimi_blerjes = $total_cost / $total_quantity;
                } else {
                    $produkti_qp->cmimi_blerjes = $new_price;
                }


                $produkti->save();
                $produkti_qp->save();
            }

            // Commit the transaction if all operations were successful
            DB::commit();

            $notification = [
                'message' => 'Blerja ishte e suksesshme',
                'alert-type' => 'success',
            ];
            return redirect()->route('shiko.blerjet')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction if any error occurs
            DB::rollBack();

            $notification = [
                'message' => 'Gabim gjatë blerjes: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function searchProduct (Request $request) {
        $query = $request->input('query');
        $products = Produkti::where('name', 'like', '%' . $query . '%')->get();
        return response()->json($products);
    }

}
