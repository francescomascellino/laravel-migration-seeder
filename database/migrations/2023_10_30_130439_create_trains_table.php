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
        Schema::create('trains', function (Blueprint $table) {

            /* 
            Azienda
            Stazione di partenza
            Stazione di arrivo
            Orario di partenza
            Orario di arrivo
            Codice Treno
            Numero Carrozze
            In orario
            Cancellato 
            */

            $table->id();
            $table->string('company', 20)->nullable();
            $table->string('departure_station');
            $table->dateTime('departure_time');
            $table->string('arrival_station');
            $table->dateTime('arrival_time');
            $table->tinyInteger('train_code')->unsigned();
            $table->tinyInteger('carriages')->nullable()->unsigned();
            $table->boolean('delay')->default(0);
            $table->boolean('canceled')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trains');
    }
};
