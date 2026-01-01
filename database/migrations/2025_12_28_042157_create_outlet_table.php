<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outlet', function (Blueprint $table) {
            $table->id('id_outlet');
            $table->string('gambar_url')->nullable();
            $table->string('nama');
            $table->string('jam'); 
            $table->string('jarak'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outlet');
    }
};
