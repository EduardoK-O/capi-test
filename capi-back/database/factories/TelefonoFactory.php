<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contacto;

class TelefonoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero_telefono' => $this->faker->phoneNumber,
            'id_contacto' => Contacto::factory()
        ];
    }
}
