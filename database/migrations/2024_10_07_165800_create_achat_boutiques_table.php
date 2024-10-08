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
        Schema::create('achat_boutiques', function (Blueprint $table) {
            $table->id();

            $table->date('date_achat')->nullable();
            $table->string('reference')->nullable();
            $table->float('quantite')->nullable();
            $table->float('prix_unitaire')->nullable();
            $table->float('montant')->nullable();
            $table->bigInteger('article_id')->nullable();
            $table->bigInteger('livreur_id')->nullable();
             $table->bigInteger('annee_id')->nullable();
           
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
        Schema::dropIfExists('achat_boutiques');
    }
};
