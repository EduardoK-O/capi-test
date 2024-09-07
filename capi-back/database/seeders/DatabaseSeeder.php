<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContactoSeeder::class);
        $this->call(TelefonoSeeder::class);
        $this->call(EmailSeeder::class);
        $this->call(DireccionSeeder::class);
    }
}
