<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unidad>
 */
class UnidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Unidad::class;
        public function definition()
        {
            return [
                'descripcion' => Str::random(20),
                'estado' => '1',
                ];
        }
}
