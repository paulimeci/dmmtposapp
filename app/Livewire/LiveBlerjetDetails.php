<?php

namespace App\Livewire;

use App\Models\Blerjet;
use Livewire\Component;

class LiveBlerjetDetails extends Component
{
    public $lista_blerjes = [];
    public function viewMore ($id){
        $this->lista_blerjes=Blerjet::where('nr_fature',$id)->get();
        $this->dispatch('open-modal');

    }

    public function render(){



        // Group by nr_fature and include necessary fields
        $blerjet = Blerjet::selectRaw('
        nr_fature,
        MAX(date) as date,
        MAX(furnitor_id) as furnitor_id,
        SUM(cmimi_blerjes*sasia) as total_cmimi_blerjes
    ')
            ->groupBy('nr_fature')
            ->orderBy('date', 'desc')
            ->orderBy('nr_fature', 'desc')
            ->has('furnitori') // Only include blerjet records with a furnitori
            ->with('furnitori') // Eager load the furnitori relationship
            ->get();

        return view('livewire.live-blerjet-details', compact('blerjet'));
    }
}
