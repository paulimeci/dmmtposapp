<?php

namespace App\Livewire;

use App\Models\Furnitoret;
use App\Models\Kategorite;
use App\Models\Njesia;
use App\Models\ProductQP;
use App\Models\Produkti;
use Livewire\Component;

class LiveShtoProduktShitja extends Component
{
    public $name;
    public $furnitori_id;
    public $unit_id;
    public $category_id;
    public $sasia_produktit;
    public $cmimi_blerjes;
    public $cmimi_produktit;
    public function openModal()
    {
        $this->showModal = true;
        $this->dispatch('openModal');
    }

    public function saveProduct()
    {
        // Validate Inputs
        $this->validate([
            'name' => 'required|string|max:255',
            'furnitori_id' => 'required|exists:furnitoret,id',
            'unit_id' => 'required|exists:njesia,id',
            'category_id' => 'required|exists:kategorite,id',
            'cmimi_produktit' => 'required|numeric|min:0',
        ]);

        // Save Product
        $produkti_ri=Produkti::create([
            'name' => $this->name,
            'furnitor_id' => $this->furnitori_id,
            'njesia_id' => $this->unit_id,
            'category_id' => $this->category_id,
            'quantity' => 0,
        ]);
        $produkt_qp=ProductQP::create([
            'product_id'=>$produkti_ri->id,
            'cmimi_blerjes'=>0,
            'price'=>$this->cmimi_produktit,
        ]);


        // Reset Form
        $this->resetForm();

        // Close Modal
        $this->showModal = false;
        $this->dispatch('closeModal');

        // Emit Event to Refresh Parent Component (if needed)
        $this->dispatch('productAdded');
    }

    // Reset Form
    private function resetForm()
    {
        $this->reset([
            'name',
            'furnitori_id',
            'unit_id',
            'category_id',
            'sasia_produktit',
            'cmimi_blerjes',
            'cmimi_produktit',
        ]);
    }


    public function render()
    {
        $furnitoret = Furnitoret::all();
        $njesia = Njesia::all();
        $kategoria = Kategorite::all();

        return view('livewire.live-shto-produkt-shitja', [
            'furnitoret' => $furnitoret,
            'njesia' => $njesia,
            'kategoria' => $kategoria,
        ]);

    }
}
