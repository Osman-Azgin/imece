<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;

class AdminTeamEditPage extends Component
{
    public $team;

    public $verify_modal=false;

    public $unverify_modal=false;

    public $delete_modal=false;

    public function mount($team_id){
        if (Team::where("id",$team_id)->count()==0){
            $this->redirect()->back();
        }
        $this->team=Team::where("id",$team_id)->first();
    }

    public function verifyTeam(){
        $this->team->verified=true;
        $this->team->save();
        $this->verify_modal=false;
    }

    public function unverifyTeam(){
        $this->team->verified=false;
        $this->team->save();
        $this->unverify_modal=false;
    }

    public function removeTeam(){
        $this->team->owner->delete();
        $this->team->delete();
        $this->delete_modal=false;
    }

    public function showDocument($file){
        return response()->download(storage_path("app/team_documents/$file"));
    }

    public function render()
    {
        return view('livewire.admin-team-edit-page');
    }
}
