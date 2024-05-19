<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Faturat;
use App\Models\FaturatDetajet;
use App\Models\Kategorite;
use App\Models\Klientet;
use App\Models\ProductQP;
use App\Models\Produkti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class FaturatController extends Controller {
    public function bejShitje(){
        $kategoria=Kategorite::all();
        $klientet = Klientet::all();
        $produkti = Produkti::with('cmimi')->get();
        $faturat_akt=Faturat::orderBy('id','desc')->first();
        if($faturat_akt==null){
            $invoice_no=1;
        }else{
            $invoice_data = Faturat::orderBy('id','desc')->first()->nr_fature;
            $invoice_no = $invoice_data+1;
        }
        $date=date('Y-m-d');
        return view('agent.shto_fature', compact('invoice_no', 'kategoria', 'klientet', 'date', 'produkti'));
    }

    public function gjejStokun(Request $request){

        $product_id = $request->product_id;
        $stock = Produkti::where('id',$product_id)->first()->quantity;

        return response()->json($stock);
    }
/*    public function search(Request $request){
        $query = $request->get('query');
        $products = Produkti::where('name', 'like', '%'.$query.'%')->limit(5)->get();
        return view('partials.product_suggestions')->with('products', $products);
    }*/

    public function kryejShitjen (Request $request){

        //dd($request);
        $fatura=new Faturat();
        $existingInvoiceNo = $request->invoice_no;
        $existingFatura = Faturat::where('nr_fature', $existingInvoiceNo)->first();
        if ($existingFatura) {
            $maxInvoiceNo = Faturat::max('nr_fature') + 1;

            $fatura->nr_fature=$maxInvoiceNo;
            $fatura->date = Carbon::now();
            $fatura->pershkrimi=$request->description;
            $fatura->agjent_id=Auth::user()->id;
        }else{
            $maxInvoiceNo=$request->invoice_no;
            $fatura->nr_fature=$maxInvoiceNo;
            $fatura->date = Carbon::now();
            $fatura->pershkrimi=$request->description;
            $fatura->agjent_id=Auth::user()->id;
        }
        if($fatura->save()){
            $pro_tot=count($request->product_id);
            for($i=0; $i<$pro_tot; $i++){
                $shitjet=new FaturatDetajet();
                $shitjet->id_fatures=$maxInvoiceNo;
                $shitjet->produkt_id=$request->product_id[$i];
                $shitjet->sasia_shitur=$request->selling_qty[$i];
                $shitjet->cmimi_nj=$request->unit_price[$i];
                $shitjet->cmimi_total=$request->selling_price[$i];
                $shitjet->blerja_njesi=$request->cmimi_blerjes[$i];
                $shitjet->blerjet_total=$request->cmimi_blerjes[$i]*$request->selling_qty[$i];
                if($shitjet->save()){
                    $produkti=Produkti::where('id', $request->product_id[$i])->first();
                    $produkti->quantity=((float)($produkti->quantity))-((float)($request->selling_qty[$i]));
                    $produkti->save();
                }
            }
        }
        if($request->discount_percentage){
            $disck= new Discount();
            $disck->fatura_id=$maxInvoiceNo;
            $disck->shifra=$request->discount_percentage;
            $disck->save();
        }

        return redirect()->route('agent.print_conferma', compact('maxInvoiceNo'));
        //return redirect()->back();
    }

    public function shikoFaturat(){
        $date=date('Y-m-d');
        $agjenti=Auth::user()->id;
        $faturat = Faturat::
        leftJoinSub(function ($query) {
            $query->select('id_fatures', \DB::raw('SUM(cmimi_total) as total_cmimi'))
                ->from('faturat_detajet')->groupBy('id_fatures'); // Added 'data' to the GROUP BY clause
        }, 'q1', function ($join) {
            $join->on('faturat.nr_fature', '=', 'q1.id_fatures');
        })
            ->whereDate('date', $date)->where('agjent_id', $agjenti)->latest()->get();
        return view('agent.shiko_faturat',compact('faturat'));
    }
    public function shikoFaturatData($id){
        $date=$id;
        $agjenti=Auth::user()->id;
        $faturat = Faturat::
        leftJoinSub(function ($query) {
            $query->select('id_fatures', \DB::raw('SUM(cmimi_total) as total_cmimi'))
                ->from('faturat_detajet')->groupBy('id_fatures'); // Added 'data' to the GROUP BY clause
        }, 'q1', function ($join) {
            $join->on('faturat.nr_fature', '=', 'q1.id_fatures');
        })
            ->whereDate('date', $date)->where('agjent_id', $agjenti)->latest()->get();
        return view('agent.shiko_faturat',compact('faturat'));
    }

    public function fshijFaturen($id) {
        DB::transaction(function () use ($id) {
            $faturatDetajet = FaturatDetajet::where('id_fatures', $id)->get(); //mar te dhenat nga FaturaDetajet
            foreach ($faturatDetajet as $fatureDetajet) { //per secilin element nga fatura detajet
                $produkti = Produkti::find($fatureDetajet->produkt_id); //mar produktin qe ka id e produktit nga tab produkti
                if ($produkti) { //nese produkti ekzisotn
                    $produkti->quantity += $fatureDetajet->sasia_shitur; //i shtoj sasine qe ka te tabela shitjeve
                    $produkti->save(); //ruaj te dhenat
                }
            }
            FaturatDetajet::where('id_fatures', $id)->delete();
            Faturat::where('nr_fature', $id)->delete();
            Discount::where('fatura_id', $id)->delete();
        });

        $notification = array(
            'message' => 'Invoice Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function printoFaturen ($id){
        $fatura_qe_do_printohet = Faturat::with('zbritjet')->where('nr_fature',$id)->first();
        return view('agent.printo_faturen', compact('fatura_qe_do_printohet'));


    }
    public function riprontoFaturen ($id){
        $fatura_qe_do_printohet = Faturat::with('zbritjet')->where('nr_fature',$id)->first();
        return view('agent.printo_faturen', compact('fatura_qe_do_printohet'));
    }

    public function editoFaturen ($id){
        $fatura=Faturat::where('nr_fature',$id)->first();
        $klientet=Klientet::all();
        $agjentet=User::where('level', 2)->get();
        $allFatura = Faturat::with('zbritjet')->with('fatura_detajet')->where('nr_fature',$id)->findOrFail($fatura->id);
        return view('agent.edito_faturen', compact('allFatura', 'klientet','agjentet'));
    }

    public function perditesoFaturen (Request $request){
        $update=Faturat::findOrFail($request->id_fatures);
        $update->date=$request->data;
        $update->agjent_id=$request->agent_id;
        $update->klient_id=$request->customer_id;
        if($update->save()){
            $skonto=Discount::where('fatura_id',$request->id_fat_s)->first();
            if($skonto){
                $skonto->shifra=$request->zbritja;
                $skonto->save();
            }else{
                $skonto_add=new Discount();
                $skonto_add->fatura_id=$request->id_fat_s;
                $skonto_add->shifra=$request->zbritja;
                $skonto_add->save();
            }
        }

        return redirect()->back();
    }

    public function updateProdShitur(Request $request){

        $pertuperditesuar=FaturatDetajet::findOrFail($request->id_pro_sh);
        $vlera_old=$pertuperditesuar->sasia_shitur;
        $vlera_new=$request->sasia;
       // dd($vlera_new, $vlera_old);
        $vlera = Produkti::findOrFail($request->id_produktit);
        $vlera_re=($vlera->quantity)-($vlera_new-$vlera_old);
        $sasia_tot=($request->sasia)*($request->cmimi);
        $pertuperditesuar->sasia_shitur=$request->sasia;
        $pertuperditesuar->cmimi_nj=$request->cmimi;
        $pertuperditesuar->cmimi_total=$sasia_tot;
        if($pertuperditesuar->save()){
            $pro=Produkti::findOrFail($request->id_produktit);
            $pro->quantity=$vlera_re;
            $pro->save();
        }
        return redirect()->back();



    }
    public function prodPerTuFshire ($id){
        $del=FaturatDetajet::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function updateProd ($id1, $id2, $id3, $id4){
        dd($id1,$id2,$id3,$id4);
        $pertuperditesuar=FaturatDetajet::findOrFail($id1);
        $vlera_old=$pertuperditesuar->sasia_shitur;
        $vlera_new=$id2;
        // dd($vlera_new, $vlera_old);
        $vlera = Produkti::findOrFail($id4);
        $vlera_re=($vlera->quantity)-($vlera_new-$vlera_old);
        $sasia_tot=($id2)*($id3);
        $pertuperditesuar->sasia_shitur=$id2;
        $pertuperditesuar->cmimi_nj=$id3;
        $pertuperditesuar->cmimi_total=$sasia_tot;
        if($pertuperditesuar->save()){
            $pro=Produkti::findOrFail($id4);
            $pro->quantity=$vlera_re;
            $pro->save();
        }
        return redirect()->back();
    }


    public function faturatPermbledhje(){
        $date=date('Y-m-d');
        $agjenti=Auth::user()->id;
        $faturat = Faturat::selectRaw('DATE(date) as dita, sum(shum_fature) as total_shum_fature, sum(blerja_total) as total_blerja_total, sum((shifra/100)*shum_fature) as total_discount')
            ->leftJoin('discounts', 'faturat.nr_fature', '=', 'discounts.fatura_id')
            ->leftJoin(DB::raw('(select id_fatures, sum(cmimi_total) as shum_fature, sum(blerjet_total) as blerja_total from faturat_detajet GROUP BY id_fatures) as q1'), 'q1.id_fatures', '=', 'faturat.nr_fature')
            ->groupBy('dita')
            ->orderBy('dita', 'desc')
            ->take(10) // Limit to top 5 records
            ->get();
        return view('agent.faturat_permbledhje',compact('faturat','date'));
    }
    public function faturatPermbledhjeData(Request $request){
        $date=$request->start_date;
        $agjenti=Auth::user()->id;
        $faturat = Faturat::selectRaw('DATE(date) as dita, sum(shum_fature) as total_shum_fature, sum((shifra/100)*shum_fature) as total_discount')
            ->leftJoin('discounts', 'faturat.nr_fature', '=', 'discounts.fatura_id')
            ->leftJoin(DB::raw('(select id_fatures, sum(cmimi_total) as shum_fature from faturat_detajet GROUP BY id_fatures) as q1'), 'q1.id_fatures', '=', 'faturat.nr_fature')
            ->where(DB::raw('DATE(date)'), $date)
            ->groupBy('dita')
            ->orderBy('dita', 'desc')
            ->get();
        return view('agent.faturat_permbledhje',compact('faturat','date'));
    }

    public function printConferma($maxInvoiceNo)
    {
        return view('agent.print_conferma', compact('maxInvoiceNo'));
    }
}
