<?php

namespace Database\Seeders;

use App\Enums\CivilStatus;
use App\Enums\EducationLevel;
use App\Models\Address;
use App\Models\Assisted;
use App\Models\Contact;
use App\Models\Voluntary;
use Illuminate\Database\Seeder;

class RandomAssistedSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake('pt_BR');
        $civilStatusOptions = array_map(fn (CivilStatus $status): string => $status->value, CivilStatus::cases());
        $educationOptions = array_map(fn (EducationLevel $level): string => $level->value, EducationLevel::cases());
        $voluntaryIds = Voluntary::query()->pluck('id')->all();

        if (empty($voluntaryIds)) {
            return;
        }

        for ($index = 1; $index <= 100; $index++) {
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

            Assisted::create([
                'contact_id' => $contact->id,
                'address_id' => $address->id,
                'voluntary_id' => $faker->randomElement($voluntaryIds),
                'name' => $faker->name(),
                'email' => $faker->optional()->safeEmail(),
                'taxvat' => sprintf('%03d.%03d.%03d-%02d', $faker->numberBetween(0, 999), $faker->numberBetween(0, 999), $faker->numberBetween(0, 999), $faker->numberBetween(0, 99)),
                'dob' => $faker->date('Y-m-d', '-18 years'),
                'civil_status' => $faker->randomElement($civilStatusOptions),
                'education_level' => $faker->randomElement($educationOptions),
                'profession' => $faker->jobTitle(),
                'jobless' => $faker->boolean(20),
                'active' => true,
                'life_history' => $faker->optional()->paragraph(),
                'health_history' => $faker->optional()->paragraph(),
                'continuous_medication' => $faker->optional()->sentence(),
            ]);
        }
    }
}
