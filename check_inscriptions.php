<?php

require __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use App\Models\Course;
use App\Models\Inscription;
use App\Models\Character;

// Cargar la configuración de Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== RESUMEN DE ESTUDIANTES INSCRITOS ===\n\n";

// Verificar usuarios
$users = User::where('email', 'like', 'test%@example')->get();
echo "👤 USUARIOS DE PRUEBA:\n";
foreach ($users as $user) {
    echo "- {$user->name} ({$user->email}) - Contraseña: revisar UserSeeder\n";
}
echo "\n";

// Verificar cursos
$courses = Course::all();
echo "📚 CURSOS DISPONIBLES:\n";
foreach ($courses as $course) {
    echo "- {$course->name}: {$course->description}\n";
    echo "  Token: {$course->token}\n";
}
echo "\n";

// Verificar inscripciones
$inscriptions = Inscription::with(['user', 'course'])->get();
echo "📝 INSCRIPCIONES ACTIVAS:\n";
if ($inscriptions->count() > 0) {
    foreach ($inscriptions as $inscription) {
        echo "- {$inscription->user->name} inscrito en: {$inscription->course->name}\n";
        echo "  Email: {$inscription->user->email}\n";
        echo "  Contraseña: verificar UserSeeder.php\n";
        echo "  ─────────────────────────\n";
    }
} else {
    echo "❌ No hay inscripciones encontradas.\n";
}
echo "\n";

// Verificar personajes
$characters = Character::with(['inscription.user', 'inscription.course'])->get();
echo "🧙 PERSONAJES CON INSCRIPCIONES:\n";
if ($characters->count() > 0) {
    foreach ($characters as $character) {
        if ($character->inscription) {
            echo "- Personaje: {$character->name} ({$character->gender})\n";
            echo "  Usuario: {$character->inscription->user->name}\n";
            echo "  Email: {$character->inscription->user->email}\n";
            echo "  Curso: {$character->inscription->course->name}\n";
            echo "  ─────────────────────────\n";
        }
    }
} else {
    echo "❌ No hay personajes encontrados.\n";
}

echo "\n=== DATOS PARA LOGIN ===\n";
echo "Puedes usar cualquiera de estos usuarios para probar:\n\n";

$testUsers = User::where('email', 'like', 'test%@example')->get();
foreach ($testUsers as $user) {
    $inscription = Inscription::where('id_user', $user->id)->first();
    $hasCharacter = Character::whereHas('inscription', function($q) use ($user) {
        $q->where('id_user', $user->id);
    })->exists();
    
    echo "📧 Email: {$user->email}\n";
    echo "🔑 Contraseña: ver UserSeeder.php\n";
    echo "📚 Inscrito: " . ($inscription ? "Sí ({$inscription->course->name})" : "No") . "\n";
    echo "🧙 Tiene personaje: " . ($hasCharacter ? "Sí" : "No") . "\n";
    echo "──────────────────────\n";
}
