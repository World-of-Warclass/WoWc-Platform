<?php

namespace Database\Seeders;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'name' => 'Bases de Datos Fundamentales',
            'description' => 'Curso introductorio a bases de datos relacionales y NoSQL',
            'token' => base64_encode('course_token_' . time()),
        ]);
    }
}
