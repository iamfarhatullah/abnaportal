<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('intake_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('university_id')->nullable()->constrained()->nullOnDelete();
            $table->string('course');
            $table->foreignId('portal_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('status_id')->nullable()->constrained()->nullOnDelete();
            $table->text('notes')->nullable();
            $table->string('portal_url')->nullable();
            $table->timestamp('applied_on')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_preferences');
    }
};
