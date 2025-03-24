<?php

namespace App\Livewire;

use App\Models\Furnitoret;
use App\Models\Kategorite;
use App\Models\Njesia;
use App\Models\Produkti;
use Livewire\Component;

class LiveMenaxhoProduktet extends Component
{

    public $name, $furnitori_id, $unit_id, $category_id, $njesia_id, $sasia_produktit, $cmimi_produktit,$cmimi_blerjes;

    public $name_upd, $quantity_upd, $price_upd, $furnitori_upd, $kategoria_upd,$njesia_upd,$cmimi_blerjes_upd;
    public $proid;


    public function editProduct($id)
    {
        $produkti = Produkti::findOrFail($id);

        // Assigning values directly to the Livewire properties
        $this->proid = $produkti->id;
        $this->name_upd = $produkti->name;
        $this->quantity_upd = $produkti->quantity;
        $this->price_upd = $produkti->cmimi->price;

        // Assigning the related entities' ids for dropdowns
        $this->furnitori_upd = $produkti->furnitori->id; // Assign furnitori id
        $this->kategoria_upd = $produkti->category->id; // Assign category id
        $this->njesia_upd = $produkti->unit->id; // Assign unit id

        // Assigning the cmimi_blerjes value from the related model
        $this->cmimi_blerjes_upd = $produkti->cmimi->cmimi_blerjes;
    }

    public function updateProduct()
    {
        // Validation
        $this->validate([
            'name_upd' => 'required|string|max:255',
            'quantity_upd' => 'required|numeric|min:0',
            'price_upd' => 'required|numeric|min:0',
            'cmimi_blerjes_upd' => 'required|numeric|min:0',
            'furnitori_upd' => 'required',
            'kategoria_upd' => 'required',
            'njesia_upd' => 'required',
        ]);

        // Find the product
        $produkti = Produkti::findOrFail($this->proid);

        // Update product fields
        $produkti->name = $this->name_upd;
        $produkti->quantity = $this->quantity_upd;
        $produkti->furnitor_id = $this->furnitori_upd;
        $produkti->category_id = $this->kategoria_upd;
        $produkti->njesia_id = $this->njesia_upd;

        // Save the updated product
        $produkti->save();

        // Update product price in the ProduktQP table
        $pro_qp = ProduktQP::where('product_id', $produkti->id)->first();
        if ($pro_qp) {
            $pro_qp->price = (int) $this->price_upd;
            $pro_qp->cmimi_blerjes = (int) $this->cmimi_blerjes_upd;
            $pro_qp->save();
        }

        // Flash success message
        session()->flash('message', 'Product Updated Successfully!');

        // Emit an event to close the modal
        $this->dispatch('productUpdated');
    }



    public function render()
    {
        $produktet=Produkti::all();
        $kategorite=Kategorite::all();
        $njesia=Njesia::all();
        $furnitoret=Furnitoret::all();
        return view('livewire.live-menaxho-produktet',compact('produktet','kategorite','njesia','furnitoret'));
    }
}
