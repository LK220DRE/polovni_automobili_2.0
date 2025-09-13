<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tip_goriva', function (Blueprint $table) {
            $table->id();
            $table->string('naziv'); // e.g. Benzin, Dizel, Električni
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tip_goriva');
    }
};
