<?php

namespace Database\Factories;


use App\Models\Achat;
use App\Models\Annee;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;


class AchatFactory extends Factory
{
    /**
     * Factory de la table Achat scolaires .
     *
     * @var string
     */
    protected $model = Achat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [


            'date_achat' => $this->faker->date,
            'reference' => "000000",

               'quantite' => $this->faker->numberBetween(1, 15),
               'prix_unitaire' => $this->faker->numberBetween(10000, 15000),
               'montant' => $this->faker->numberBetween(1000, 1500),


               'produit_id' => $this->faker->randomElement(Produit::pluck('id')),
               'fournisseur_id' => $this->faker->randomElement(Fournisseur::pluck('id')),
               'annee_id' => $this->faker->randomElement(Annee::pluck('id')),

                'statut_livraison' => $this->faker->numberBetween(1, 2),




        ];
    }


}
