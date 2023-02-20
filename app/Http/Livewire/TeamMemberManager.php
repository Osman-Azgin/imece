<?php

namespace App\Http\Livewire;

use App\Actions\Jetstream\AddTeamMember;
use Livewire\Component;
use Laravel\Jetstream\Http\Livewire\TeamMemberManager as BaseTeamMemberManager;

class TeamMemberManager extends BaseTeamMemberManager
{
    /**
     * The "add team member" form state.
     *
     * @var array
     */
    public $addTeamMemberForm = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'password' => '',
        'password_confirmation' => '',
        'role' => null,
    ];

    /**
     * Add a new team member to a team.
     *
     * @return void
     */
    public function addTeamMember()
    {
        $this->resetErrorBag();

        app(AddTeamMember::class)->add(
            $this->user,
            $this->team,
            $this->addTeamMemberForm['name'],
            $this->addTeamMemberForm['email'],
            $this->addTeamMemberForm['phone'],
            $this->addTeamMemberForm['password'],
            $this->addTeamMemberForm['password_confirmation'],
            $this->addTeamMemberForm['role']
        );

        $this->addTeamMemberForm = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'password' => '',
            'password_confirmation' => '',
            'role' => null,
        ];

        $this->team = $this->team->fresh();

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.team-member-manager');
    }
}
