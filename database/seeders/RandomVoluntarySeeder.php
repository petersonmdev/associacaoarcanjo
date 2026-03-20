<?php

namespace Database\Seeders;

use App\Enums\Driving;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Voluntary;
use Illuminate\Database\Seeder;

class RandomVoluntarySeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake('pt_BR');
        $drivingOptions = array_map(fn (Driving $driving): string => $driving->value, Driving::cases());

        for ($index = 1; $index <= 30; $index++) {
            $address = Address::create([
                'zipcode' => preg_replace('/\D/', '', $faker->postcode()),
                'address' => $faker->streetName(),
                'number' => $faker->optional()->numberBetween(1, 9999),
                'complement' => $faker->optional()->secondaryAddress(),
                'neighborhood' => $faker->citySuffix(),
                'city' => $faker->city(),
                'state' => $faker->stateAbbr(),
            ]);

            $contact = Contact::create([
                'phone_number_whatsapp' => $faker->phoneNumber(),
                'phone_number1' => $faker->optional()->phoneNumber(),
                'phone_number2' => $faker->optional()->phoneNumber(),
            ]);

            Voluntary::create([
                'user_id' => null,
                'address_id' => $address->id,
                'contact_id' => $contact->id,
                'name' => $faker->name(),
                'email' => "voluntario{$index}.{$faker->unique()->safeEmail()}",
                'taxvat' => sprintf('%03d.%03d.%03d-%02d', $faker->numberBetween(0, 999), $faker->numberBetween(0, 999), $faker->numberBetween(0, 999), $faker->numberBetween(0, 99)),
                'dob' => $faker->date('Y-m-d', '-18 years'),
                'driving' => $faker->randomElement($drivingOptions),
                'active' => true,
            ]);
        }
    }
}
