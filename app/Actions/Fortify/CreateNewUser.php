<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\TeamAbility;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:11', 'min:10'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'org_name' => ['required', 'string', 'max:255'],
            'org_type' => ['required', 'integer', 'max:3',"min:1"],
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                $this->createTeam($user,$input);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user,array $input): void
    {
        $team=$user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => $input["org_name"],
            'type' => $input["org_type"],
            'personal_team' => true,
        ]));
        $this->createTeamAbilities($team,$input);
    }

    protected function createTeamAbilities(Model $team,array $input){
        if (isset($input["yardim-toplama-dagitma"])){
            $abl=new TeamAbility();
            $abl->team_id=$team->id;
            $abl->ability="yardim-toplama-dagitma";
            $abl->save();
        }
        if (isset($input["lojistik"])){
            $abl=new TeamAbility();
            $abl->team_id=$team->id;
            $abl->ability="lojistik";
            $abl->save();
        }
    }
}
