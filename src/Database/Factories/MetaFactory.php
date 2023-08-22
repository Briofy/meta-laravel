<?php

namespace Database\Factories;

use Briofy\Meta\Models\Meta;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetaFactory extends Factory
{
    protected $model = Meta::class;

    public function definition()
    {
        return [
            'key' => $this->faker->word(),
            'value' => $this->faker->word()
        ];
    }
}
