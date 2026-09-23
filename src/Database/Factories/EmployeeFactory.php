<?php

namespace Shazzoo\Employees\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shazzoo\Employees\Models\Employee;

/**
 * @extends Factory<Employee>
 */
final class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'image_id' => null,
            'name' => fake()->name(),
            'role' => fake()->jobTitle(),
            'skills' => fake()->randomElements([
                'Laravel',
                'PHP',
                'Product design',
                'Project management',
                'AI',
            ], 3),
        ];
    }
}
