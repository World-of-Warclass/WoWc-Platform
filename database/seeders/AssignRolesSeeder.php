<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos usuarios master (teachers)
        $masterUser1 = User::factory()->create([
            'name' => 'Master',
            'paternal_surname' => 'Teacher',
            'maternal_surname' => 'One',
            'username' => 'master1',
            'email' => 'master1@example.com',
            'password' => 'password123',
        ]);
        $masterUser1->assignRole('user');

        // Crear registro de teacher para este usuario
        Teacher::create([
            'id_user' => $masterUser1->id,
            'id_institution' => 1, // TECSUP
        ]);

        $masterUser2 = User::factory()->create([
            'name' => 'Master',
            'paternal_surname' => 'Teacher',
            'maternal_surname' => 'Two',
            'username' => 'master2',
            'email' => 'master2@example.com',
            'password' => 'password123',
        ]);
        $masterUser2->assignRole('user');

        Teacher::create([
            'id_user' => $masterUser2->id,
            'id_institution' => 2, // UTEC
        ]);

        // Crear algunos usuarios player
        $playerUser1 = User::factory()->create([
            'name' => 'Player',
            'paternal_surname' => 'Student',
            'maternal_surname' => 'One',
            'username' => 'player1',
            'email' => 'player1@example.com',
            'password' => 'password123',
        ]);
        $playerUser1->assignRole('user');

        $playerUser2 = User::factory()->create([
            'name' => 'Player',
            'paternal_surname' => 'Student',
            'maternal_surname' => 'Two',
            'username' => 'player2',
            'email' => 'player2@example.com',
            'password' => 'password123',
        ]);
        $playerUser2->assignRole('user');
    }
}