<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Telefono;

class TelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Telefono::factory()->count(5000)->create();
    }
}
