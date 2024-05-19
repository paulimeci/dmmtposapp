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
        Schema::create('faturat_detajet', function (Blueprint $table) {
            $table->id();
            $table->integer('id_fatures');
            $table->integer('produkt_id');
            $table->double('sasia_shitur');
            $table->double('cmimi_nj');
            $table->double('cmimi_total');
            $table->double('blerja_njesi');
            $table->double('blerjet_total');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faturat_detajet');
    }
};
