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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('libelle')->nullable();
            $table->float('quantite_initiale')->nullable();
            $table->float('prix_unitaire_achat')->nullable();
            $table->float('prix_unitaire_vente')->nullable();
            $table->string('photo')->nullable();
            $table->string('unite_stock')->nullable();
            $table->string('unite_achat')->nullable();
            $table->float('equivalence')->nullable();

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
        Schema::dropIfExists('articles');
    }
};
