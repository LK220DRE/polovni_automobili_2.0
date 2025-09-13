<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fotografije', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oglas_id')->constrained('oglasi')->onDelete('cascade');
            $table->string('putanja'); // File path of the image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fotografije');
    }
};
