<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RequirementDeailArea extends Component
{
    public $requirement;

    public function mount($requirement){
        $this->requirement=$requirement;
    }

    public function render()
    {
        return view('livewire.requirement-deail-area');
    }
}
