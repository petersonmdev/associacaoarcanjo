<?php

namespace App\Livewire\Voluntary;

use Livewire\Component;
use App\Enums\Status;
use App\Enums\Driving;
use App\Repositories\AddressRepository;
use App\Repositories\AssistedRepository;
use App\Repositories\ContactRepository;
use App\Repositories\UserRepository;
use App\Repositories\VoluntaryRepository;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CreateVoluntary extends Component
{
    public string $searchAssisted = '';
    public bool $showSuggestedAssisteds = false;
    public bool $createUserVoluntary = false;
    public ?string $cepError = null;
    public ?string $lastFetchedCep = null;
    public int $cepRequestSeq = 0;
    public int $activeCepRequestSeq = 0;
    public $dontKnowZipcode = false;
    public ?int $pendingTransferAssistedId = null;
    public ?string $pendingTransferAssistedName = null;
    public ?string $pendingTransferVoluntaryName = null;

    public array $formData = [
        'name' => '',
        'dob' => '',
        'active' => Status::ATIVO,
        'taxvat' => '',
        'phone' => '',
        'email' => '',
        'driving' => '',
        'address' => [
            'zipcode' => '',
            'street' => '',
            'number' => '',
            'complement' => '',
            'neighborhood' => '',
            'city' => '',
            'state' => '',
        ],
        'assisted_id' => [],
        'user_password' => '',
    ];

    protected function rules(): array
    {
        return [
            'formData.name' => 'required|string|max:255',
            'formData.dob' => ['regex:/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/'],
            'formData.taxvat' => 'regex:/^\d{3}\x2E\d{3}\x2E\d{3}\x2D\d{2}$/',
        'formData.email' => $this->createUserVoluntary ? 'required|email' : 'nullable|email',
            'formData.user_password' => [$this->createUserVoluntary ? 'required' : 'nullable', 'string', 'min:6'],
            'formData.address.zipcode' => $this->dontKnowZipcode ? 'min:8|max:9' : 'required|min:8|max:9',
            'formData.address.street' => 'required|string|max:150',
            'formData.address.number' => 'nullable|integer',
            'formData.address.complement' => 'string|max:100',
            'formData.address.neighborhood' => 'required|string|max:100',
            'formData.address.city' => 'required|string|max:100',
            'formData.address.state' => 'required|string|max:2',
        ];
    }

    protected function messages(): array
    {
        return [
            'formData.*.required' => 'Campo obrigatório.',
            'formData.*.max' => 'Tamanho máximo do campo excedido.',
            'formData.address.street.required' => 'O endereço é obrigatório.',
            'formData.address.neighborhood.required' => 'O bairro é obrigatório.',
            'formData.address.city.required' => 'A cidade é obrigatória.',
            'formData.address.state.required' => 'O estado é obrigatório.',
            'formData.dob.regex' => 'Data inválida.',
            'formData.taxvat.regex' => 'CPF inválido.',
            'formData.email.email' => 'E-mail inválido.',
            'formData.address.zipcode.regex' => 'CEP inválido.',
            'formData.address.zipcode.required' => 'O CEP é obrigatório.',
        ];
    }

    protected function validationAttributes(): array
    {
      return [
        'formData.address.zipcode' => 'CEP',
        'formData.address.street' => 'endereço',
        'formData.address.number' => 'número',
        'formData.address.complement' => 'complemento',
        'formData.address.neighborhood' => 'bairro',
        'formData.address.city' => 'cidade',
        'formData.address.state' => 'estado',
      ];
    }

    public function mount(?array $data = null): void
    {
      if (is_array($data)) {
        $this->formData = array_replace_recursive($this->formData, $data);
      }

      $this->dontKnowZipcode = (bool) ($this->formData['address']['dontKnowZipcode'] ?? false);
    }

    public function updatedDontKnowZipcode(bool $value): void
    {
        $this->formData['address']['dontKnowZipcode'] = $value;
        if ($value) {
            $this->formData['address']['zipcode'] = '';
            $this->cepError = null;
            $this->resetErrorBag('formData.address.zipcode');
        }
    }

    private function normalizeCep(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    private function clearAddressFields(): void
    {
        $this->formData['address']['street'] = '';
        $this->formData['address']['number'] = '';
        $this->formData['address']['complement'] = '';
        $this->formData['address']['neighborhood'] = '';
        $this->formData['address']['city'] = '';
        $this->formData['address']['state'] = '';
    }

    public function updatedFormDataAddressZipcode($value): void
    {
      $this->cepError = null;

      $cep = $this->normalizeCep((string) $value);

      if ($this->lastFetchedCep !== null && $cep !== $this->lastFetchedCep) {
        $this->clearAddressFields();
        $this->lastFetchedCep = null;
      }

      if (strlen($cep) !== 8) {
        return;
      }

      $this->fetchAddressByCep($cep);
    }

    public function fetchAddressByCepFromZipcode(): void
    {
      $this->cepError = null;

      $cep = $this->normalizeCep((string) ($this->formData['address']['zipcode'] ?? ''));

      if ($this->lastFetchedCep !== null && $cep !== $this->lastFetchedCep) {
        $this->clearAddressFields();
        $this->lastFetchedCep = null;
      }

      if (strlen($cep) !== 8) {
        return;
      }

      $this->fetchAddressByCep($cep);
    }

    public function fetchAddressByCep(string $cep): void
    {
        if ($this->lastFetchedCep === $cep) {
          return;
        }

        $this->cepError = null;
        $this->clearAddressFields();

        $seq = ++$this->cepRequestSeq;
        $this->activeCepRequestSeq = $seq;

        try {
            $response = Http::timeout(5)
              ->retry(1, 200)
              ->get("https://viacep.com.br/ws/{$cep}/json/");

            if ($this->activeCepRequestSeq !== $seq) {
              return;
            }

            if (!$response->ok()) {
              $this->cepError = 'Não foi possivel consultar o CEP no momento';
              return;
            }

            $payload = $response->json();

            if (!is_array($payload) || ($payload['erro'] ?? false)) {
              $this->cepError = 'CEP não encontrado';
              return;
            }

            $this->formData['address']['street'] = $payload['logradouro'] ?? '';
            $this->formData['address']['neighborhood'] = $payload['bairro'] ?? '';
            $this->formData['address']['city'] = $payload['localidade'] ?? '';
            $this->formData['address']['state'] = $payload['uf'] ?? '';

            $this->lastFetchedCep = $cep;

            $this->dispatch('focus-number-address');

        } catch (\Exception $e) {
            if ($this->activeCepRequestSeq === $seq) {
              $this->cepError = 'Tempo esgotado ao consultar o CEP. Tente novamente.';
            }
        } catch (\Throwable $e) {
            $this->cepError = 'Ocorreu um erro ao consultar o CEP. Tente novamente.';
        }
    }

    public function render()
    {
        $search = trim($this->searchAssisted);
      $selectedIds = $this->selectedAssistedIds();
        $address = $this->formData['address'] ?? [];
        $neighborhood = trim((string) ($address['neighborhood'] ?? ''));
        $city = trim((string) ($address['city'] ?? ''));
        $state = trim((string) ($address['state'] ?? ''));

        $suggestedAssisteds = ! $this->showSuggestedAssisteds || strlen($search) < 2
            ? collect()
            : AssistedRepository::prioritizeWithoutVoluntaryFirst(
              AssistedRepository::findByAssistedNameComplete($search)
            )
            ->whereNotIn('assisteds.id', $selectedIds)
                ->limit(8)
                ->get();

        $addressSuggestedAssisteds = ($neighborhood === '' || $city === '' || $state === '')
            ? collect()
            : AssistedRepository::prioritizeWithoutVoluntaryFirst(
              AssistedRepository::findByAddressComplete($neighborhood, $city, $state)
            )
            ->whereNotIn('assisteds.id', $selectedIds)
                ->limit(8)
                ->get();

        return view('livewire.voluntary.create-voluntary', [
            'statuses' => Status::cases(),
            'drivingOptions' => Driving::cases(),
            'selectedAssisteds' => AssistedRepository::findByIdsComplete($selectedIds),
            'suggestedAssisteds' => $suggestedAssisteds,
            'addressSuggestedAssisteds' => $addressSuggestedAssisteds,
        ]);
    }

    private function selectedAssistedIds(): array
    {
        return array_values(array_filter(array_map('intval', $this->formData['assisted_id'] ?? [])));
    }

    private function saveUser(): ?int
    {
        if (! $this->createUserVoluntary) {
            return null;
        }

        try {
            $user = UserRepository::create([
                'name' => $this->formData['name'],
                'email' => $this->formData['email'],
                'password' => Hash::make($this->formData['user_password']),
            ]);

            return $user->id;
        } catch (Exception $e) {
            Log::error($e);
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Ocorreu um erro ao cadastrar o usuário do voluntário.',
                position: 'center',
                timer: 1500
            );
            return null;
        }
    }

    private function saveContact(): ?int
    {
      try {
        $contact = ContactRepository::create([
          'phone_number_whatsapp' => $this->formData['phone'] ?? '',
        ]);
        return $contact->id;
      } catch (Exception $e) {
        Log::error($e);
        $this->dispatch(
          'alert',
          type: 'error',
          title: 'Ocorreu um erro ao cadastrar o(s) telefone(s).',
          position: 'center',
          timer: 1500
        );
        return null;
      }
    }

    private function saveAddress(): ?int
    {
      try {
        $number = $this->formData['address']['number'] ?? null;

        $address = AddressRepository::create([
          'zipcode' => $this->formData['address']['zipcode'] ?? '',
          'address' => $this->formData['address']['street'] ?? '',
          'number' => $number === '' ? null : $number,
          'complement' => $this->formData['address']['complement'] ?? '',
          'neighborhood' => $this->formData['address']['neighborhood'] ?? '',
          'city' => $this->formData['address']['city'] ?? '',
          'state' => $this->formData['address']['state'] ?? '',
        ]);
        return $address->id;
      } catch (Exception $e) {
        Log::error($e);
        $this->dispatch(
          'alert',
          type: 'error',
          title: 'Ocorreu um erro ao cadastrar o endereço.',
          position: 'center',
          timer: 1500
        );
        return null;
      }
    }

    private function saveVoluntary()
    {
        try {
        $userId = null;

            if ($this->createUserVoluntary) {
          $userId = $this->saveUser();
            }

            $contactId = $this->saveContact();
            if ($contactId === null) {
                return null;
            }

            $addressId = $this->saveAddress();
            if ($addressId === null) {
                return null;
            }

            $voluntary = VoluntaryRepository::create([
        'user_id' => $userId,
                'address_id' => $addressId,
                'contact_id' => $contactId,
                'name' => $this->formData['name'],
              'email' => (string) ($this->formData['email'] ?? ''),
                'taxvat' => $this->formData['taxvat'],
                'dob' => $this->formData['dob'],
                'driving' => $this->formData['driving'],
                'active' => $this->formData['active'],
            ]);

            if (isset($this->formData['assisted_id']) && is_array($this->formData['assisted_id'])) {
                foreach ($this->formData['assisted_id'] as $assistedId) {
                $assisted = AssistedRepository::find((int) $assistedId);
                    if ($assisted) {
                        $assisted->voluntary_id = $voluntary->id;
                        $assisted->save();
                    }
                }
            }

            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Voluntário cadastrado com sucesso.',
                position: 'center',
                timer: 1500
            );
              $this->resetFormAfterSave();
        } catch (Exception $e) {
            Log::error($e);
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Ocorreu um erro ao cadastrar o voluntário.',
                position: 'center',
                timer: 1500
            );
        }
        return null;
    }

      private function resetFormAfterSave(): void
      {
        $this->reset('formData');
        $this->clearPendingTransfer();
        $this->showSuggestedAssisteds = false;
        $this->searchAssisted = '';
        $this->dontKnowZipcode = false;
        $this->lastFetchedCep = null;
        $this->cepError = null;
        $this->createUserVoluntary = false;
        $this->dispatch('focus-name-voluntary');
      }

    public function save(): void
    {
      if (! $this->createUserVoluntary && (($this->formData['email'] ?? '') === '')) {
        $this->formData['email'] = null;
      }

      $this->validate();
      $this->saveVoluntary();
    }

    public function addAssisted(int $assistedId): void
    {
        $selectedIds = $this->selectedAssistedIds();

        if (! in_array($assistedId, $selectedIds, true)) {
            $selectedIds[] = $assistedId;
        }

        $this->formData['assisted_id'] = $selectedIds;
        $this->searchAssisted = '';
        $this->clearPendingTransfer();
    }

      public function queueAssistedAddition(int $assistedId): void
      {
        $assisted = AssistedRepository::findByIdComplete($assistedId);

        if ($assisted && !empty($assisted->voluntary_name)) {
          $this->pendingTransferAssistedId = (int) $assistedId;
          $this->pendingTransferAssistedName = (string) $assisted->name;
          $this->pendingTransferVoluntaryName = (string) $assisted->voluntary_name;
          return;
        }

        $this->addAssisted($assistedId);
      }

      public function confirmTransferAndAddAssisted(): void
      {
        if ($this->pendingTransferAssistedId === null) {
          return;
        }

        $this->addAssisted($this->pendingTransferAssistedId);
      }

      public function cancelTransferAssisted(): void
      {
        $this->clearPendingTransfer();
      }

      private function clearPendingTransfer(): void
      {
        $this->pendingTransferAssistedId = null;
        $this->pendingTransferAssistedName = null;
        $this->pendingTransferVoluntaryName = null;
      }

    public function openAssistedSuggestions(): void
    {
        $this->showSuggestedAssisteds = true;
    }

    public function removeAssisted(int $assistedId): void
    {
        $this->formData['assisted_id'] = array_values(array_filter(
            $this->selectedAssistedIds(),
            fn (int $selectedId): bool => $selectedId !== $assistedId
        ));
    }

    public function updatedCreateUserVoluntary(bool $value): void
    {
        if (! $value) {
            $this->formData['user_password'] = '';
        }
    }

    public function placeholder()
    {
      return <<<'HTML'
        <div class="m-auto text-center">
          <p class="mt-4 mb-2 text-center text-primary">Carregando</p>
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(105, 108, 255, 1); transform: scaleX(-1);">
            <path d="M12 22c5.421 0 10-4.579 10-10h-2c0 4.337-3.663 8-8 8s-8-3.663-8-8c0-4.336 3.663-8 8-8V2C6.579 2 2 6.58 2 12c0 5.421 4.579 10 10 10z">
              <animateTransform attributeName="transform" type="rotate" dur=".4s" values="0 12 12;360 12 12;" repeatCount="indefinite"></animateTransform>
            </path>
          </svg>
        </div>
        HTML;
    }
}
