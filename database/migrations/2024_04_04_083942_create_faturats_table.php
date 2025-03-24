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
        Schema::create('faturat', function (Blueprint $table) {
            $table->id();
            $table->integer('nr_fature')->unique();
            $table->dateTime('date');
            $table->text('pershkrimi')->nullable();
            $table->integer('status')->default(1);
            $table->integer('agjent_id');
            $table->integer('klient_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faturat');
    }
};
