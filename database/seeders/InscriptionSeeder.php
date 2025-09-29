<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscription;

class InscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear inscripciones para los personajes existentes
        // Asumiendo que hay al menos 1 curso y los primeros 6 usuarios son estudiantes
        
        Inscription::create([
            'id_user' => 1, // test@example
            'id_course' => 1,
        ]);

        Inscription::create([
            'id_user' => 2, // test2@example
            'id_course' => 1,
        ]);

        Inscription::create([
            'id_user' => 3, // test3@example
            'id_course' => 1,
        ]);

        Inscription::create([
            'id_user' => 4, // test4@example
            'id_course' => 1,
        ]);

        Inscription::create([
            'id_user' => 5, // test5@example
            'id_course' => 1,
        ]);

        Inscription::create([
            'id_user' => 6, // test6@example
            'id_course' => 1,
        ]);
    }
}
