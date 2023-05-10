<?php

namespace Database\Factories;

use App\Models\AssetCategory;
use App\Models\AssetDepartment;
use App\Models\AssetLocation;
use App\Models\AssetManufacturer;
use App\Models\AssetModel;
use App\Models\AssetStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->numerify('#####'),
            'serialnumber' => $this->faker->bothify('?#??#???##?'),
            'macaddress' => $this->faker->macAddress,

            'purchasedate' => $this->faker->date,
            'purchasecost' => $this->faker->randomFloat('2', '1', '1000'),
            'purchaselink' => $this->faker->url,

            'monthprice' => $this->faker->randomFloat('2', '1', '1000'),
            'duration' => $this->faker->randomDigitNotNull,

            'ordernumber' => 'R-'. $this->faker->numerify('####-##-##-#'),
            'warranty' => $this->faker->date,

            'model_id' => $this->faker->randomElement(AssetModel::pluck('id')),
            'category_id' => $this->faker->randomElement(AssetCategory::pluck('id')),
            'status_id' => $this->faker->randomElement(AssetStatus::pluck('id')),
            'manufacturer_id' => $this->faker->randomElement(AssetManufacturer::pluck('id')),
            'location_id' => $this->faker->randomElement(AssetLocation::pluck('id')),
            'department_id' => $this->faker->randomElement(AssetDepartment::pluck('id')),

        ];
    }
}
