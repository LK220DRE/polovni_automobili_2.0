<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('karoserije', function (Blueprint $table) {
            $table->id();
            $table->string('naziv'); // e.g. Limuzina, Hečbek, Karavan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karoserije');
    }
};
