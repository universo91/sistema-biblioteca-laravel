<?php

use Illuminate\Database\Seeder;

class TablaLibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Libro::class, 50)->create();
    }
}
