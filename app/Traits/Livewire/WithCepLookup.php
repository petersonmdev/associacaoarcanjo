<?php

namespace App\Traits\Livewire;

use Illuminate\Support\Facades\Http;

/**
 * Provides CEP (zipcode) lookup for Livewire components with flat address properties.
 *
 * Required properties in the using class:
 *   public string $zipcode;
 *   public string $street;
 *   public string $number;       (or int)
 *   public string $complement;
 *   public string $neighborhood;
 *   public string $city;
 *   public string $state;
 *   public bool   $dontKnowZipcode;
 */
trait WithCepLookup
{
    public ?string $cepError = null;
    public ?string $lastFetchedCep = null;
    public int $cepRequestSeq = 0;
    public int $activeCepRequestSeq = 0;

    private function normalizeCep(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    private function clearAddressFields(): void
    {
        $this->street = '';
        $this->neighborhood = '';
        $this->city = '';
        $this->state = '';
    }

    public function updatedZipcode($value): void
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

        $cep = $this->normalizeCep((string) ($this->zipcode ?? ''));

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
                $this->cepError = 'Não foi possível consultar o CEP no momento.';
                return;
            }

            $payload = $response->json();

            if (!is_array($payload) || ($payload['erro'] ?? false)) {
                $this->cepError = 'CEP não encontrado.';
                return;
            }

            $this->street       = $payload['logradouro'] ?? '';
            $this->neighborhood = $payload['bairro']     ?? '';
            $this->city         = $payload['localidade'] ?? '';
            $this->state        = $payload['uf']         ?? '';

            $this->lastFetchedCep = $cep;

            $this->dispatch('focus-number-voluntary');

        } catch (\Exception $e) {
            if ($this->activeCepRequestSeq === $seq) {
                $this->cepError = 'Tempo esgotado ao consultar o CEP. Tente novamente.';
            }
        } catch (\Throwable $e) {
            $this->cepError = 'Ocorreu um erro ao consultar o CEP. Tente novamente.';
        }
    }

    public function updatedDontKnowZipcode($value): void
    {
        if ($value) {
            $this->zipcode = '';
            $this->cepError = null;
            $this->resetErrorBag('zipcode');
        }
    }
}
