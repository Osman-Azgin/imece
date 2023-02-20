<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;

class AdminTeamsPage extends Component
{
    public $teams=[];

    public $teams_total_count;

    public $teams_filtered_count;

    public $page=1;

    public $per_page=25;

    public $only_verified=false;

    public $only_has_documents=false;

    public $only_unverified=false;

    public $only_type=null;

    public $search=null;

    public function mount()
    {
        $this->loadTeams();
    }

    public function loadTeams(){
        $teams=Team::whereNot("created_at",null);

        $this->teams_total_count=$teams->count();

        if ($this->only_verified){
            $teams=$teams->where("verified",1);
        }elseif ($this->only_has_documents){
            $teams=$teams->where("verified",0)->where("has_documents",true);
        }elseif ($this->only_unverified){
            $teams=$teams->where("verified",0);
        }

        if ($this->only_type){
            $teams=$teams->where("type",$this->only_type);
        }

        if ($this->search){
            $teams=$teams->where("name","like","%$this->search%");
        }

        $this->teams_filtered_count=$teams->count();

        $teams=$teams->offset(($this->page-1)*$this->per_page)->limit($this->per_page);

        $this->teams=$teams->orderBy("id","desc")->get();
    }

    public function changePage($page){
        $this->page=$page;
        $this->loadTeams();
    }

    public function detail($team_id){
        $this->redirect("/admin/team/$team_id");
    }

    public function render()
    {
        return view('livewire.admin-teams-page');
    }
}
