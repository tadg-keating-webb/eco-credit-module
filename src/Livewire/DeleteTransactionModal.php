<?php

namespace TadgKeatingWebb\EcoCreditModule\Livewire;

use LivewireUI\Modal\ModalComponent;
use TadgKeatingWebb\EcoCreditModule\Models\Transaction;

class DeleteTransactionModal extends ModalComponent
{
    public ?int $transactionId;

    public function mount(int $transaction)
    {
        $this->transactionId = $transaction;
    }

    public function render()
    {
        return view('eco-credit-module::livewire.delete-modal');
    }

    public function resetState()
    {
        $this->transactionId = null;
    }

    public function delete()
    {
        Transaction::find($this->transactionId)->delete();

        $this->dispatch('refresh-transactions');

        $this->closeModal();
    }
}
