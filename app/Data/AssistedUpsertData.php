<?php

declare(strict_types=1);

namespace App\Data;

class AssistedUpsertData
{
  private function __construct(
    private array $assistedData,
    private array $contactData,
    private array $addressData,
    private array $dependentsData,
    private array $incomesData
  ) {}

  public static function fromCreateFormData(array $formData): self
  {
    $number = $formData['number'] ?? null;

    return new self(
      assistedData: array_merge($formData, [
        'voluntary_id' => !empty($formData['voluntary_id']) ? (int) $formData['voluntary_id'] : null,
      ]),
      contactData: [
        'phone_number_whatsapp' => $formData['phone_number_whatsapp'] ?? '',
        'phone_number1' => $formData['phone_number1'] ?? '',
        'phone_number2' => $formData['phone_number2'] ?? '',
      ],
      addressData: [
        'zipcode' => $formData['zipcode'] ?? '',
        'address' => $formData['address'] ?? '',
        'number' => $number === '' ? null : $number,
        'complement' => $formData['complement'] ?? '',
        'neighborhood' => $formData['neighborhood'] ?? '',
        'city' => $formData['city'] ?? '',
        'state' => $formData['state'] ?? '',
      ],
      dependentsData: array_map(static function (array $dependent): array {
        return [
          'name' => $dependent['dependent_name'] ?? null,
          'dob' => $dependent['dependent_dob'] ?? null,
          'sex' => $dependent['dependent_sex'] ?? null,
          'parentage' => $dependent['dependent_parentage'] ?? null,
          'profession' => $dependent['dependent_occupation'] ?? null,
          'pne' => $dependent['dependent_pne'] ?? false,
        ];
      }, $formData['dependents'] ?? []),
      incomesData: array_map(static function (array $income): array {
        return [
          'name' => $income['name'] ?? null,
          'incomes' => $income['value'] ?? null,
        ];
      }, $formData['incomes'] ?? [])
    );
  }

  public static function fromUpdateFields(array $fields): self
  {
    return new self(
      assistedData: [
        'voluntary_id' => $fields['voluntary_id'] ?? null,
        'name' => $fields['name'] ?? '',
        'email' => $fields['email'] ?? '',
        'taxvat' => $fields['taxvat'] ?? '',
        'dob' => $fields['dob'] ?? '',
        'civil_status' => $fields['civil_status'] ?? '',
        'education_level' => $fields['education_level'] ?? '',
        'profession' => $fields['profession'] ?? '',
        'jobless' => (bool) ($fields['jobless'] ?? false),
        'active' => $fields['active'] ?? 1,
        'life_history' => $fields['life_history'] ?? '',
        'health_history' => $fields['health_history'] ?? '',
        'continuous_medication' => $fields['continuous_medication'] ?? '',
      ],
      contactData: [
        'phone_number_whatsapp' => $fields['phone_number_whatsapp'] ?? '',
        'phone_number1' => $fields['phone_number1'] ?? '',
        'phone_number2' => $fields['phone_number2'] ?? '',
      ],
      addressData: [
        'zipcode' => $fields['zipcode'] ?? '',
        'address' => $fields['address'] ?? '',
        'number' => $fields['number'] ?? null,
        'complement' => $fields['complement'] ?? '',
        'neighborhood' => $fields['neighborhood'] ?? '',
        'city' => $fields['city'] ?? '',
        'state' => $fields['state'] ?? '',
      ],
      dependentsData: array_values(array_map(static function (array $dependent): array {
        return [
          'id' => $dependent['id'] ?? null,
          'name' => $dependent['name'] ?? null,
          'dob' => $dependent['dob'] ?? null,
          'sex' => $dependent['sex'] ?? null,
          'parentage' => $dependent['parentage'] ?? null,
          'profession' => $dependent['profession'] ?? null,
          'pne' => (bool) ($dependent['pne'] ?? false),
        ];
      }, $fields['dependents'] ?? [])),
      incomesData: array_values(array_map(static function (array $income): array {
        return [
          'id' => $income['id'] ?? null,
          'name' => $income['name'] ?? null,
          'incomes' => isset($income['incomes']) ? (float) $income['incomes'] : null,
        ];
      }, $fields['incomes'] ?? []))
    );
  }

  public function assistedData(): array
  {
    return $this->assistedData;
  }

  public function contactData(): array
  {
    return $this->contactData;
  }

  public function addressData(): array
  {
    return $this->addressData;
  }

  public function dependentsData(): array
  {
    return $this->dependentsData;
  }

  public function incomesData(): array
  {
    return $this->incomesData;
  }
}
