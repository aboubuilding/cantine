<?php

namespace Database\Factories;



use App\Models\Annee;
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
        return [


            'libelle' => $this->faker->word,
            'responsable' => $this->faker->name,

               'type_magasin' => $this->faker->numberBetween(1, 2),

                'description' => $this->faker->text,





        ];
    }


}
