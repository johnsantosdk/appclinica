<?php

use Illuminate\Database\Seeder;
use App\Paciente;

class PacientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Paciente::class, 50)->create();
    }
}
