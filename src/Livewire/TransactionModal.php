<?php

namespace EcoCredit\EcoCreditModule\Livewire;

use LivewireUI\Modal\ModalComponent;
use EcoCredit\EcoCreditModule\Livewire\Forms\TransactionForm;
use EcoCredit\EcoCreditModule\Models\Transaction;

class TransactionModal extends ModalComponent
{
    public TransactionForm $form;

    public string $type;

    public function mount(?Transaction $transaction, $userId, $type)
    {
        $this->type = $type;

        $transaction->transaction_type = $type;

        $this->form->setTransaction($transaction, $userId);
    }

    public function render()
    {
        return view("eco-credit-module::livewire.forms.{$this->type}-form");
    }

    public function submit()
    {
        $this->form->save();

        $this->dispatch('refresh-transactions');

        $this->closeModal();
    }

    public function resetState()
    {
        $this->form->setTransaction(new Transaction, $this->form->userId);
    }
}
