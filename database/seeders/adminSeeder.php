<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::create([
            'name' => "Admin",
            'email' => "admin@admin",
            'phone' => "1234567890",
            'password' => Hash::make("xyzadmin")]);
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => "Admins",
            'type' => "1",
            'personal_team' => true,
            "verified" => true,
            "is_admin" => true,
        ]));
    }
}
