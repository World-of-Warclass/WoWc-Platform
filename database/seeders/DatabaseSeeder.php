<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            InstitutionSeeder::class,
            AssignRolesSeeder::class,
            QuizSeeder::class,
            CourseSeeder::class,
            TeacherSeeder::class,
            Teacher_CourseSeeder::class,
            EventSeeder::class,
            ClasseSeeder::class,
            InscriptionSeeder::class,
            CharacterSeeder::class,
        ]);
    }
}
