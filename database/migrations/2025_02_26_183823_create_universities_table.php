<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('picture')->nullable(); // For image paths
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade'); // Country reference
            $table->foreignId('region_id')->nullable()->constrained('regions')->onDelete('cascade'); // Region reference
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('universities');
    }
};
