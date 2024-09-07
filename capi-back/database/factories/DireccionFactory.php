<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contacto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Direccion>
 */
class DireccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'calle' => $this->faker->streetAddress(),
            'ciudad' => $this->faker->city(),
            'estado' => $this->faker->state(),
            'pais' => $this->faker->country(),
            'codigo_postal' => $this->faker->postcode(),
            'contacto_id' => Contacto::factory()
        ];
    }
}
