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
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();

            $table->date('date_mouvement')->nullable();
            $table->string('reference')->nullable();
            $table->bigInteger('produit_id')->nullable();
            $table->bigInteger('magasin_id')->nullable();
            $table->bigInteger('annee_id')->nullable();
            $table->float('quantite')->nullable();

            $table->tinyInteger('type_mouvement')->nullable();
            $table->bigInteger('menu_id')->nullable();
            $table->float('montant')->nullable();

            $table->integer('etat')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mouvements');
    }
};
