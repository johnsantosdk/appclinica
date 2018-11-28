<?php

use Faker\Generator as Faker;

require __DIR__ .'/vendor/autoload.php';

$factory->define(App\Paciente::class, function (Faker $faker) {

	$cpf = $faker->addProvider(new FakerBR($faker->cpf));

	$sexo = $faker->randomElement(['Masculino', 'Feminino']);
    return [
        'nome' => $faker->name,
        'sexo' => $sexo,
        'nascimento' => $faker->date($format = 'd-m-Y', $max = 'now'),
        'cpf' => $cpf,
        'email' => $faker->safeEmail,
    ];
});
