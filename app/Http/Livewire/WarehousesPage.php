<?php

namespace App\Http\Livewire;

use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WarehousesPage extends Component
{
    public $warehouses=[];

    public function mount(){
        $this->warehouses=Warehouse::where("team_id",Auth::user()->currentTeam->id)->get();
    }

    public function newWarehouse(){
        $this->redirect("/warehouse");
    }

    public function edit($warehouse_id){
        $this->redirect("/warehouse/".$warehouse_id);
    }

    public function render()
    {
        return view('livewire.warehouses-page');
    }
}
