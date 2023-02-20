<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeamNotVerifiedPage extends Component
{
    public function sendToVerification(){
        $team=Auth::user()->currentTeam;
        $team->has_documents=true;
        $team->save();
    }
    public function render()
    {
        return view('livewire.team-not-verified-page');
    }
}
