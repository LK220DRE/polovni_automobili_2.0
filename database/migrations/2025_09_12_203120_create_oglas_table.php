<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
            Schema::create('oglasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('naslov');   // <—— DODAJ OVO
            $table->string('marka');
            $table->string('model');
            $table->year('godiste');
            $table->unsignedInteger('cena');
            $table->text('opis');
            $table->unsignedInteger('kilometraza');
            $table->unsignedSmallInteger('snaga_motora');
            $table->string('boja');
            $table->string('lokacija');
            $table->enum('status', ['na_čekanju','odobren','odbijen','prodat'])->default('na_čekanju');
            $table->foreignId('tip_goriva_id')->constrained('tip_goriva');
            $table->foreignId('karoserija_id')->constrained('karoserije');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oglasi');
    }
};
