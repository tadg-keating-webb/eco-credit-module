<?php

namespace EcoCredit\EcoCreditModule\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use EcoCredit\EcoCreditModule\Models\Transaction;

class TransactionForm extends Form
{
    public $transaction;

    public $userId;

    #[Validate('required|numeric|gt:0')]
    public ?int $amount;

    #[Validate('required')]
    public ?string $type;

    #[Validate('required')]
    public ?string $date;

    public $transaction_type;

    public function setTransaction(?Transaction $transaction, $userId)
    {
        $this->transaction = $transaction;
        $this->userId = $userId;
        $this->type = $transaction->type ?? '';
        $this->amount = $transaction->amount ?? 0;
        $this->date = $transaction->date ?? '';
        $this->transaction_type = $transaction->transaction_type ?? '';
    }

    public function save()
    {
        $this->validate();

        if ($this->transaction->id) {
            $this->transaction->update(
                [
                    'type' => $this->type,
                    'amount' => $this->amount,
                    'date' => $this->date,
                    'transaction_type' => $this->transaction_type,
                ]
            );
        } else {
            Transaction::create(
                [
                    'type' => $this->type,
                    'amount' => $this->amount,
                    'date' => $this->date,
                    'user_id' => $this->userId,
                    'transaction_type' => $this->transaction_type,
                ]
            );
        }
    }
}
