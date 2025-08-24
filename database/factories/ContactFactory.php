<?php

namespace Database\Factories;

use App\Infrastructure\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->optional()->companyEmail(),
            'opening_hours' => $this->faker->optional()->randomElement([
                'Mon-Fri: 9 AM - 6 PM',
                'Mon-Sat: 10 AM - 8 PM',
                '24/7 Service',
            ]),
            'latitude' => $this->faker->latitude(-90, 90),
            'longitude' => $this->faker->longitude(-180, 180),
        ];
    }
}
