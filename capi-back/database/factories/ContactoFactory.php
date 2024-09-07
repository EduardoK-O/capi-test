<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'notas' => $this->faker->paragraph,
            'fecha_cumpleanios' => $this->faker->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
            'pagina_web' => $this->faker->url(),
            'created_at' => now()
        ];
    }
}
