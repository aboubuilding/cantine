<?php

namespace Database\Factories;




use App\Models\Magasin;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

        $unitestocks = ['kg', 'g', 'hg', ];
        return [


            'libelle' => $this->faker->word,
            'quantite_initiale' => $this->faker->name,

               'prix_unitaire_achat' => $this->faker->numberBetween(10000, 20000),
               'prix_unitaire_vente' => $this->faker->numberBetween(10000, 20000),

                'unite_stock' => $this->faker->text,





        ];
    }


}
