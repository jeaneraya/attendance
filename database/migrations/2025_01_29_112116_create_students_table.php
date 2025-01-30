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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('last_name')->nullable;
            $table->string('first_name')->nullable;
            $table->string('middle_name')->nullable;
            $table->string('student_id')->nullable;
            $table->string('course')->nullable;
            $table->string('year_level')->nuullable;
            $table->string('qr_code')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
