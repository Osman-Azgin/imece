<?php

namespace App\Http\Livewire;

use App\Models\Imece;
use App\Models\Requirement;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class RequirementDetailPage extends Component
{
    public $requirement;

    public $imece=null;

    public $delete_modal=false;

    public $satisfy_modal=false;

    public $satisfy_date=null;

    public $warehouses=[];

    public $warehouse_id=null;

    public $prev;


    public function mount($requirement_id=null){
        if ($requirement_id){
            if (Requirement::where("id",$requirement_id)->count()==0){
                $this->redirect("/dahboard");
                return;
            }
            $this->requirement = Requirement::where("id",$requirement_id)->first();
            if (Imece::where("requirement_id",$this->requirement->id)->count()>0){
                $this->imece=Imece::where("requirement_id",$this->requirement->id)->first();
            }
        }else{
            $this->requirement = new Requirement();
        }
        $this->prev = url()->previous();
        $this->satisfy_date=\date("Y-m-d",strtotime("today"));
        $this->warehouses=Warehouse::where("team_id",Auth::user()->currentTeam->id)->get();
    }

    function satisfy(){
        if (!$this->warehouse_id){
            $this->addError("satisfy",__("Please select warehouse"));
            return;
        }
        if (!$this->satisfy_date){
            $this->addError("satisfy",__("Please select deadline"));
            return;
        }
        if (Imece::where("requirement_id",$this->requirement->id)->count()>0){
            $this->addError("satisfy",__("Already satisfied"));
            return;
        }
        $imece=new Imece();
        $imece->team_id=Auth::user()->currentTeam->id;
        $imece->requirement_id=$this->requirement->id;
        $imece->warehouse_id=$this->warehouse_id;
        $imece->deadline=$this->satisfy_date;
        $imece->save();
        session()->flash('success', __("The requirement has been satisfied!"));
        $this->redirect("/requirement/" . $this->requirement->id);
    }

    function removeSatisfyError(){
        $this->resetErrorBag('satisfy');
    }

    function delete(){
        if($this->requirement->warehouse->team_id==Auth::user()->currentTeam->id && !$this->imece){
            $this->requirement->delete();
            session()->flash('success', __("The requirement has been deleted!"));
            $this->redirect("/myrequirements");
        }else{
            abort(403);
        }
    }

    function back(){
        $this->redirect($this->prev);
    }

    public function render()
    {
        return view('livewire.requirement-detail-page');
    }
}
