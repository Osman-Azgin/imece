<?php

namespace App\Http\Livewire;

use App\Models\Imece;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyImece extends Component
{
    public $imeces=[];

    public function mount(){
        $this->loadImeces();
    }

    function loadImeces(){
        $this->imeces=Imece::where("team_id",Auth::user()->currentTeam->id)->get();
    }

    function detail($requirement_id){
        $this->redirect("/requirement/$requirement_id");
    }

    public function render()
    {
        return view('livewire.my-imece');
    }
}
