<?php

namespace App\Http\Livewire;

use App\Models\Requirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MyRequirementsPage extends Component
{
    public $currentRequirements=[];

    public $oldRequirements=[];

    public function mount(){
        $this->currentRequirements=Requirement::join("warehouses","warehouses.id","=","requirements.warehouse_id")->where("warehouses.team_id",Auth::user()->currentTeam->id)
            ->leftJoin("imeces","imeces.requirement_id","=","requirements.id")->groupBy("requirements.id")->groupBy("requirements.warehouse_id")->groupBy("requirements.in_kind_donation_id")
                ->groupBy("requirements.created_at")->groupBy("requirements.updated_at")
                    ->having(DB::raw("COUNT(imeces.id)"),"<",1)->select(DB::raw("requirements.*,COUNT(imeces.id) AS imeceCount"))
                        ->orderBy("requirements.id","desc")->get();
        $this->oldRequirements=Requirement::join("warehouses","warehouses.id","=","requirements.warehouse_id")->where("warehouses.team_id",Auth::user()->currentTeam->id)
            ->leftJoin("imeces","imeces.requirement_id","=","requirements.id")->groupBy("requirements.id")->groupBy("requirements.warehouse_id")->groupBy("requirements.in_kind_donation_id")
                ->groupBy("requirements.created_at")->groupBy("requirements.updated_at")
                    ->having("imeceCount",">",0)->select(DB::raw("requirements.*,COUNT(imeces.id) AS imeceCount"))
                        ->orderBy("requirements.id","desc")->get();
    }

    public function addRequirement(){
        $this->redirect("/requirement");
        return;
    }

    public function edit($requirement_id){
        $this->redirect("/requirement/$requirement_id");
        return;
    }

    public function render()
    {
        return view('livewire.my-requirements-page');
    }
}
