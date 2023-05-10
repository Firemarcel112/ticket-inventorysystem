<?php

namespace Database\Factories;

use App\Models\AssetManufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\License>
 */
class LicenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company . ' Lizenz',
            'licensekey' => $this->faker->bothify('?#??#???##?'),
            'manufacturer_id' => $this->faker->randomElement(AssetManufacturer::pluck('id')),
            'total' => $this->faker->randomDigitNotNull,
            'expirationdate' => $this->faker->dateTimeBetween('now', '+5 years'),
        ];
    }
}
