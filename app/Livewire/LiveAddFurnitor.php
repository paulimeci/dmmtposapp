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
    public function storeFurnitor (){
        Furnitoret::insert([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'adresa' => $this->address,

        ]);
    }
    public function fshijFurnitor ($id)
    {
        $check_if_exist=Produkti::where('furnitor_id',$id)->exists();
        if(!$check_if_exist){
            Furnitoret::find($id)->delete();
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
        $this->dispatch('show-edit-modal');
    }

    public function updateFurnitor()
    {
        $this->validate([
            'edit_name' => 'required',

        ]);

        Furnitoret::find($this->edit_furnitor_id)->update([
            'name' => $this->edit_name,
            'phone' => $this->edit_phone,
            'email' => $this->edit_email,
            'adresa' => $this->edit_address,
        ]);

        $this->dispatch('hide-edit-modal');
        session()->flash('message', 'Furnitor updated successfully!');
    }
    public function render()
    {
        $furnitoret=Furnitoret::all();
        return view('livewire.live-add-furnitor',compact('furnitoret'));
    }
}
