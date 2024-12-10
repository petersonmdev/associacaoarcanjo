<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456789'),
        ]);

        $adminAddress = \App\Repositories\AddressRepository::create([
            'zipcode' => '99999999',
            'address' => 'Rua teste',
            'number' => 100,
            'complement' => 'quadra teste, lote teste',
            'neighborhood' => 'sul',
            'city' => 'Trindade',
            'state' => 'GO'
        ]);

        $adminContact = \App\Repositories\ContactRepository::create([
            'phone_number_whatsapp' => '(99)99999-9999',
            'phone_number1' => '(99)99999-9999',
            'phone_number2' => '(99)99999-9999'
        ]);

        \App\Repositories\VoluntaryRepository::create([
          'name' => 'Administrador Voluntário',
          'user_id' => $adminUser->id,
          'address_id' => $adminAddress->id,
          'contact_id' => $adminContact->id,
          'taxvat' => '999.999.999-99',
          'dob' => '1999-01-01',
          'email' => 'voluntario@email.com',
          'driving' => true,
        ]);
    }
}
