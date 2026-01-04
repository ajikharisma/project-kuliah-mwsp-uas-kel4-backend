<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rating', function (Blueprint $table) {
            $table->decimal('stars', 2, 1)->after('produk_id');
            $table->text('comment')->nullable()->after('stars');
        });
    }

    public function down(): void
    {
        Schema::table('rating', function (Blueprint $table) {
            $table->dropColumn(['stars', 'comment']);
        });
    }
};
