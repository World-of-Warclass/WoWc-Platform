<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers_courses_quests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_teacher_course');
            $table->unsignedBigInteger('id_quest');
            $table->timestamps();

            $table->foreign('id_teacher_course')->references('id')->on('teachers_courses');
            $table->foreign('id_quest')->references('id')->on('quests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers_courses_quests');
    }
};
