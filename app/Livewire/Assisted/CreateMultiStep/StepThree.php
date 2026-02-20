<?php

namespace App\Livewire\Assisted\CreateMultiStep;

use App\Enums\BrazilStates;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StepThree extends Component
{
  public array $data = [
    'zipcode' => '',
    'address' => '',
    'number' => '',
    'complement' => '',
    'neighborhood' => '',
    'city' => '',
    'state' => '',
  ];
  public ?string $cepError = null;
  public ?string $lastFetchedCep = null;
  public int $cepRequestSeq = 0;
  public int $activeCepRequestSeq = 0;

  #[Validate([
    'data.zipcode' => ['required', 'regex:/^\d{5}-\d{3}$/'],
    'data.address' => 'required|string|max:150',
    'data.number' => 'required|numeric',
    'data.neighborhood' => 'required|string|max:100',
    'data.city' => 'required|string|max:100',
    'data.state' => 'required|string|max:2',
  ], message: [
    'data.*.required' => 'Campo obrigatório.',
    'data.*.numeric' => 'O campo deve conter apenas números.',
    'data.*.max' => 'Tamanho máximo do campo excedido.',
    'data.zipcode.regex' => 'CEP inválido.',
  ])]

  public function mount($data)
  {
    $this->data = $data;
  }

  private function normalizeCep(string $value): string
  {
    return preg_replace('/[^0-9]/', '', $value);
  }

  private function clearAddressFields(): void
  {
    $this->data['address'] = '';
    $this->data['neighborhood'] = '';
    $this->data['city'] = '';
    $this->data['state'] = '';
  }

  public function updatedDataZipcode($value): void
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

    $cep = $this->normalizeCep((string) ($this->data['zipcode'] ?? ''));

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

      $this->data['address'] = $payload['logradouro'] ?? '';
      $this->data['neighborhood'] = $payload['bairro'] ?? '';
      $this->data['city'] = $payload['localidade'] ?? '';
      $this->data['state'] = $payload['uf'] ?? '';

      $this->lastFetchedCep = $cep;

      $this->dispatch('focus-number-address');

    } catch (ConnectionException $e) {
      if ($this->activeCepRequestSeq === $seq) {
        $this->cepError = 'Tempo esgotado ao consultar o CEP. Tente novamente.';
      }
    } catch (\Throwable $e) {
      if ($this->activeCepRequestSeq === $seq) {
        $this->cepError = 'Falha ao consultar seu CEP. Tente novamente.';
      }
    }
  }

  public function validateStep()
  {
    $this->validate();
    $this->dispatch('stepValidated', ['data' => $this->data]);
  }

  public function back()
  {
    $this->dispatch('goToPreviousStep');
  }

  public function render()
  {
    return view('livewire.assisted.create-multi-step.step-three', [
      'states' => BrazilStates::cases(),
    ]);
  }

  public function placeholder()
  {
    return <<<'HTML'
      <div class="m-auto text-center">
        <p class="mt-4 mb-2 text-center text-primary">Carregando formulário</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(105, 108, 255, 1); transform: scaleX(-1);">
          <path d="M12 22c5.421 0 10-4.579 10-10h-2c0 4.337-3.663 8-8 8s-8-3.663-8-8c0-4.336 3.663-8 8-8V2C6.579 2 2 6.58 2 12c0 5.421 4.579 10 10 10z">
            <animateTransform attributeName="transform" type="rotate" dur=".4s" values="0 12 12;360 12 12;" repeatCount="indefinite"></animateTransform>
          </path>
        </svg>
      </div>
      HTML;
  }
}
