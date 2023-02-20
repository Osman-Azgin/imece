<?php

namespace App\Actions\Jetstream;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Team;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\Events\AddingTeamMember;
use Laravel\Jetstream\Events\TeamMemberAdded;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Rules\Role;

class AddTeamMember implements AddsTeamMembers
{
    use PasswordValidationRules;
    /**
     * Add a new team member to the given team.
     */
    public function add(User $user, Team $team, string $name, string $email, string $phone, string $password, string $confirm_password, string $role = null): void
    {
        Gate::forUser($user)->authorize('addTeamMember', $team);
        $this->validate($team, $name, $email, $phone, $password, $confirm_password, $role);
        if (User::where("email", $email)->exists()) {
            $newTeamMember = User::where("email", $email)->first();
        } else {
            $newTeamMember = User::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => Hash::make($password),
            ]);
        }
        AddingTeamMember::dispatch($team, $newTeamMember);
        $team->users()->attach(
            $newTeamMember, ['role' => $role]
        );
        $newTeamMember->switchTeam($team);
        TeamMemberAdded::dispatch($team, $newTeamMember);
    }

    /**
     * Validate the add member operation.
     */
    protected function validate(Team $team, string $name, string $email, string $phone, string $password, string $confirm_password, ?string $role): void
    {
        Validator::make([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'password_confirmation' => $confirm_password,
            'role' => $role,
        ], $this->rules(), [
            'email.exists' => __('We were unable to find a registered user with this email address.'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnTeam($team, $email)
        )->validateWithBag('addTeamMember');
    }

    /**
     * Get the validation rules for adding a team member.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function rules(): array
    {
        return array_filter([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:11', 'min:10'],
            'password' => $this->passwordRules(),
            'role' => Jetstream::hasRoles()
                            ? ['required', 'string', new Role]
                            : null,
        ]);
    }

    /**
     * Ensure that the user is not already on the team.
     */
    protected function ensureUserIsNotAlreadyOnTeam(Team $team, string $email): Closure
    {
        return function ($validator) use ($team, $email) {
            $validator->errors()->addIf(
                $team->hasUserWithEmail($email),
                'email',
                __('This user already belongs to the team.')
            );
        };
    }
}
