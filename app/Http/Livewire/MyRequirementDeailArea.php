<?php

namespace App\Http\Livewire;

use App\Models\InKindDonation;
use App\Models\Requirement;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MyRequirementDeailArea extends Component
{
    public $requirement;

    public $warehouses=[];

    public $warehouse_id=null;

    public $in_kind_donations=[];

    public $in_kind_donation_id=null;

    public function mount($requirement){
        if ($requirement->id){
            if($requirement->warehouse->team_id!=Auth::user()->currentTeam->id){
                abort(403);
            }
            $this->warehouse_id=$requirement->warehouse_id;
            $this->in_kind_donation_id=$requirement->in_kind_donation_id;
        }
        $this->in_kind_donations=InKindDonation::all();
        $this->warehouses=Warehouse::where("team_id",Auth::user()->currentTeam->id)->get();
        $this->requirement=$requirement;
    }

    public function save(){
        if (!$this->warehouse_id){
            $this->addError("form",__("Please select warehouse"));
            return;
        }
        $this->requirement->warehouse_id=$this->warehouse_id;
        if (!$this->in_kind_donation_id){
            $this->addError("form",__("Please select in-kind donation"));
            return;
        }
        //prevent dublicates
        if (!$this->requirement->id){
            $currentRequirements=Requirement::join("warehouses","warehouses.id","=","requirements.warehouse_id")->where("warehouses.team_id",Auth::user()->currentTeam->id)
                ->where("requirements.warehouse_id",$this->warehouse_id)->where("requirements.in_kind_donation_id",$this->in_kind_donation_id)
                ->leftJoin("imeces","imeces.requirement_id","=","requirements.id")->groupBy("requirements.id")->groupBy("requirements.warehouse_id")->groupBy("requirements.in_kind_donation_id")
                ->groupBy("requirements.created_at")->groupBy("requirements.updated_at")
                ->having(DB::raw("COUNT(imeces.id)"),"<",1)->select(DB::raw("requirements.*,COUNT(imeces.id) AS imeceCount"))
                ->orderBy("requirements.id","desc")->get();
            if (count($currentRequirements)>0){
                $this->addError("form",__("You can not dublicate!"));
                return;
            }
        }
        $this->requirement->in_kind_donation_id=$this->in_kind_donation_id;
        $this->requirement->save();
        session()->flash('success', __("The requirement has been saved!"));
        $this->redirect("/requirement/" . $this->requirement->id);
    }

    public function removeFormError()
    {
        $this->resetErrorBag('form');
    }

    public function render()
    {
        return view('livewire.my-requirement-deail-area');
    }
}
