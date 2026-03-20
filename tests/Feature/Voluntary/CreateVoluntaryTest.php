<?php

namespace Tests\Feature\Voluntary;

use App\Livewire\Voluntary\CreateVoluntary;
use App\Models\Address;
use App\Models\Voluntary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateVoluntaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_save_voluntary_with_empty_email_and_empty_address_number_when_not_creating_user(): void
    {
        Livewire::test(CreateVoluntary::class)
            ->set('createUserVoluntary', false)
            ->set('formData.name', 'Voluntário Teste')
            ->set('formData.dob', '1990-01-01')
            ->set('formData.taxvat', '123.456.789-00')
            ->set('formData.email', '')
            ->set('formData.driving', '')
            ->set('formData.phone', '')
            ->set('formData.address.zipcode', '74000-000')
            ->set('formData.address.street', 'Rua Teste')
            ->set('formData.address.number', '')
            ->set('formData.address.complement', '')
            ->set('formData.address.neighborhood', 'Centro')
            ->set('formData.address.city', 'Goiania')
            ->set('formData.address.state', 'GO')
            ->call('save')
            ->assertHasNoErrors();

        $voluntary = Voluntary::query()->first();

        $this->assertNotNull($voluntary);
        $this->assertSame('', $voluntary->email);

        $address = Address::query()->find($voluntary->address_id);

        $this->assertNotNull($address);
        $this->assertNull($address->number);
    }
}
