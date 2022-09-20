<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiali', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->double('peso', 255);
            $table->double('prezzo_kg', 255);
            $table->timestamp('data_creazione');
            $table->timestamp('data_modifica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiali');
    }
};
