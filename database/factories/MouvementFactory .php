<?php

namespace Database\Factories;




use App\Models\Annee;


use App\Models\Magasin;
use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MagasinFactory extends Factory
{
    /**
     * Factory de la table Magasin scolaires .
     *
     * @var string
     */
    protected $model = Magasin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [


            'date_mouvement' => $this->faker->date,
            'reference' => "MVT-000000",



               'produit_id' => $this->faker->randomElement(Produit::pluck('id')),
               'magasin_id' => $this->faker->randomElement(Magasin::pluck('id')),
               'annee_id' => $this->faker->randomElement(Annee::pluck('id')),

                'quantite' => $this->faker->numberBetween(1, 3),
                'type_mouvement' => $this->faker->numberBetween(1, 10),


        ];
    }


}
