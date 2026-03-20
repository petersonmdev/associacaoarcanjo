<?php

namespace App\Traits\Livewire;

use App\Repositories\AssistedRepository;

/**
 * Provides assisted search, suggestion, and linking for Livewire components.
 *
 * Required property in the using class:
 *   public array $selectedAssistedIds = [];
 *
 * Optional hooks (override in using class to react to add/remove):
 *   protected function onAssistedAdded(int $assistedId): void {}
 *   protected function onAssistedRemoved(int $assistedId): void {}
 *
 * Required view data (call getAssistedViewData() in render() and merge with view array):
 *   $selectedAssisteds, $suggestedAssisteds, $addressSuggestedAssisteds
 */
trait WithAssistedLinking
{
    public string $searchAssisted = '';
    public bool $showSuggestedAssisteds = false;
    public ?int $pendingTransferAssistedId = null;
    public ?string $pendingTransferAssistedName = null;
    public ?string $pendingTransferVoluntaryName = null;
    public array $selectedAssistedIds = [];

    public function openAssistedSuggestions(): void
    {
        $this->showSuggestedAssisteds = true;
    }

    public function addAssisted(int $assistedId): void
    {
        if (!in_array($assistedId, $this->selectedAssistedIds, true)) {
            $this->selectedAssistedIds[] = $assistedId;
        }

        $this->searchAssisted = '';
        $this->clearPendingTransfer();
        $this->onAssistedAdded($assistedId);
    }

    public function removeAssisted(int $assistedId): void
    {
        $this->selectedAssistedIds = array_values(array_filter(
            $this->selectedAssistedIds,
            fn(int $id): bool => $id !== $assistedId
        ));

        $this->onAssistedRemoved($assistedId);
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

    protected function getAssistedViewData(): array
    {
        $search = trim($this->searchAssisted);

        $suggestedAssisteds = !$this->showSuggestedAssisteds || strlen($search) < 2
            ? collect()
            : AssistedRepository::prioritizeWithoutVoluntaryFirst(
                AssistedRepository::findByAssistedNameComplete($search)
              )
                ->whereNotIn('assisteds.id', $this->selectedAssistedIds)
                ->limit(8)
                ->get();

        $addressSuggestedAssisteds = (!empty($this->neighborhood) && !empty($this->city) && !empty($this->state))
            ? AssistedRepository::prioritizeWithoutVoluntaryFirst(
                AssistedRepository::findByAddressComplete($this->neighborhood, $this->city, $this->state)
              )
                ->whereNotIn('assisteds.id', $this->selectedAssistedIds)
                ->limit(8)
                ->get()
            : collect();

        return [
            'selectedAssisteds' => AssistedRepository::findByIdsComplete($this->selectedAssistedIds),
            'suggestedAssisteds' => $suggestedAssisteds,
            'addressSuggestedAssisteds' => $addressSuggestedAssisteds,
        ];
    }

    // Hooks — override in using class if needed
    protected function onAssistedAdded(int $assistedId): void {}
    protected function onAssistedRemoved(int $assistedId): void {}
}
