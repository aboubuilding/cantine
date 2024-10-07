<?php

namespace Database\Factories;


use App\Models\Fournisseur;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FournisseurFactory extends Factory
{
    /**
     * Factory de la table Fournisseur scolaires .
     *
     * @var string
     */
    protected $model = Fournisseur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [


            'raison_social' => $this->faker->company,
            'nom_contact' => $this->faker->name,

               'telephone_contact' => $this->faker->phoneNumber,

                'description' => $this->faker->text,





        ];
    }


}
