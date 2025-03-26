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
        Schema::create('blerjet_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fatura_id');
            $table->integer('product_id');
            $table->double('sasia_vjeter');
            $table->double('cmimi_vjeter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blerjet_logs');
    }
};
