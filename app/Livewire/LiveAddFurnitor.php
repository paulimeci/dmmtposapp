<?php

namespace App\Livewire;

use App\Models\Furnitoret;
use App\Models\Produkti;
use Livewire\Component;

class LiveAddFurnitor extends Component
{
    public $name;
    public $phone;
    public $email;
    public $address;
    public $edit_name;
    public $edit_phone;
    public $edit_email;
    public $edit_address;
    public $edit_furnitor_id;

    protected $listeners = ['refreshDatatable' => '$refresh'];

    public function storeFurnitor()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        Furnitoret::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'adresa' => $this->address,
        ]);

        $this->reset(['name', 'phone', 'email', 'address']);
        $this->dispatch('close-modal', id: 'addSupplierModal');
        $this->dispatch('refreshDatatable');
    }

    public function fshijFurnitor($id)
    {
        $check_if_exist = Produkti::where('furnitor_id', $id)->exists();
        if (!$check_if_exist) {
            Furnitoret::find($id)->delete();
            $this->dispatch('refreshDatatable');
        }
    }

    public function editFurnitor($id)
    {
        $furnitor = Furnitoret::findOrFail($id);
        $this->edit_furnitor_id = $id;
        $this->edit_name = $furnitor->name;
        $this->edit_phone = $furnitor->phone;
        $this->edit_email = $furnitor->email;
        $this->edit_address = $furnitor->adresa;
    }

    public function updateFurnitor()
    {
        $this->validate([
            'edit_name' => 'required',
            'edit_phone' => 'required',
        ]);

        Furnitoret::find($this->edit_furnitor_id)->update([
            'name' => $this->edit_name,
            'phone' => $this->edit_phone,
            'email' => $this->edit_email,
            'adresa' => $this->edit_address,
        ]);

        $this->dispatch('close-modal', id: 'editSupplierModal'.$this->edit_furnitor_id);
        $this->dispatch('refreshDatatable');
    }

    public function render()
    {
        return view('livewire.live-add-furnitor', [
            'furnitoret' => Furnitoret::all()
        ]);
    }
}
