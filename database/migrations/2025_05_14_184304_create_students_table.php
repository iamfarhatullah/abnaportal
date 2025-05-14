<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('qualification_id')->nullable()->constrained()->nullOnDelete();
            $table->string('graduated_from')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('test')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
