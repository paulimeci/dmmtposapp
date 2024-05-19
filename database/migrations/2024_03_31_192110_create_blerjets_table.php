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
        Schema::create('blerjet', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('nr_fature')->nullable();
            $table->integer('furnitor_id')->nullable();
            $table->integer('kategori_id')->nullable();
            $table->integer('produkt_id')->nullable();
            $table->double('sasia')->nullable();
            $table->double('cmimi_blerjes')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blerjet');
    }
};
