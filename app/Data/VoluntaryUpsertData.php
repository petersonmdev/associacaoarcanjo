<?php

declare(strict_types=1);

namespace App\Data;

class VoluntaryUpsertData
{
  private function __construct(
    private array $voluntaryData,
    private array $contactData,
    private array $addressData,
    private ?array $userData,
    private array $assistedIds
  ) {}

  public static function fromCreateFormData(array $formData, bool $createUserVoluntary, array $assistedIds): self
  {
    $number = $formData['address']['number'] ?? null;

    return new self(
      voluntaryData: [
        'name' => $formData['name'] ?? '',
        'email' => (string) ($formData['email'] ?? ''),
        'taxvat' => $formData['taxvat'] ?? '',
        'dob' => $formData['dob'] ?? '',
        'driving' => $formData['driving'] ?? '',
        'active' => $formData['active'] ?? 1,
      ],
      contactData: [
        'phone_number_whatsapp' => $formData['phone'] ?? '',
      ],
      addressData: [
        'zipcode' => $formData['address']['zipcode'] ?? '',
        'address' => $formData['address']['street'] ?? '',
        'number' => $number === '' ? null : $number,
        'complement' => $formData['address']['complement'] ?? '',
        'neighborhood' => $formData['address']['neighborhood'] ?? '',
        'city' => $formData['address']['city'] ?? '',
        'state' => $formData['address']['state'] ?? '',
      ],
      userData: $createUserVoluntary
        ? [
          'name' => $formData['name'] ?? '',
          'email' => $formData['email'] ?? '',
          'password' => $formData['user_password'] ?? '',
        ]
        : null,
      assistedIds: array_values(array_unique(array_map('intval', $assistedIds))
      )
    );
  }

  public static function fromUpdateFields(array $fields, array $assistedIds): self
  {
    return new self(
      voluntaryData: [
        'name' => $fields['name'] ?? '',
        'email' => $fields['email'] ?? '',
        'taxvat' => $fields['taxvat'] ?? '',
        'dob' => $fields['dob'] ?? '',
        'driving' => $fields['driving'] ?? '',
        'active' => $fields['active'] ?? 1,
      ],
      contactData: [
        'phone_number_whatsapp' => $fields['phone'] ?? '',
      ],
      addressData: [
        'zipcode' => $fields['zipcode'] ?? '',
        'address' => $fields['street'] ?? '',
        'number' => $fields['number'] ?? null,
        'complement' => $fields['complement'] ?? '',
        'neighborhood' => $fields['neighborhood'] ?? '',
        'city' => $fields['city'] ?? '',
        'state' => $fields['state'] ?? '',
      ],
      userData: null,
      assistedIds: array_values(array_unique(array_map('intval', $assistedIds)))
    );
  }

  public function voluntaryData(): array
  {
    return $this->voluntaryData;
  }

  public function contactData(): array
  {
    return $this->contactData;
  }

  public function addressData(): array
  {
    return $this->addressData;
  }

  public function userData(): ?array
  {
    return $this->userData;
  }

  public function assistedIds(): array
  {
    return $this->assistedIds;
  }
}
