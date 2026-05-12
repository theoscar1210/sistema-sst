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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();  //columna id autoincremental (pk)
            $table->string('document_number', 20)->unique();
            $table->string('name', 100);
            $table->string('last_name', 100);
            $table->string('area', 100);
            $table->string('position', 100);
            $table->string('company', 100);
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps(); // columnas created_at y update_at automaticas
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
