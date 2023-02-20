<?php

namespace App\Http\Livewire;

use App\Models\Requirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ImeceArea extends Component
{
    public $currentRequirements=[];

    public function mount(){
        $this->loadRequirements();
    }

    public function loadRequirements(){
        $this->currentRequirements=Requirement::join("warehouses","warehouses.id","=","requirements.warehouse_id")
            ->leftJoin("imeces","imeces.requirement_id","=","requirements.id")->groupBy("requirements.id")->groupBy("requirements.warehouse_id")->groupBy("requirements.in_kind_donation_id")
            ->groupBy("requirements.created_at")->groupBy("requirements.updated_at")
            ->having(DB::raw("COUNT(imeces.id)"),"<",1)->select(DB::raw("requirements.*,COUNT(imeces.id) AS imeceCount"))
            ->orderBy("requirements.id","desc")->get();
    }

    public function detail($requirement_id){
        $this->redirect("/requirement/$requirement_id");
        return;
    }

    public function render()
    {
        return view('livewire.imece-area');
    }
}
