<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeamDocuments extends Component
{
    public $documents=[];

    public function mount(){
        $this->documents=Auth::user()->currentTeam->documents;
    }

    public function addDocument(){

    }

    public function render()
    {
        return view('livewire.team-documents');
    }
}
