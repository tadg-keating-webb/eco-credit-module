<?php

namespace TadgKeatingWebb\EcoCreditModule\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use TadgKeatingWebb\EcoCreditModule\Models\Transaction;

class TransactionsComponent extends Component
{
    public $transactions;

    public $userName;

    public $userId;

    public $balance;

    public $type;

    public function mount($userId, $type)
    {
        $this->userId = $userId;
        $this->type = $type;

        $this->transactions = Transaction::where('user_id', $this->userId)
            ->where('transaction_type', $this->type)
            ->orderBy('date', 'DESC')->get();

        $this->balance = $this->getBalance();
    }

    #[On('refresh-transactions')]
    public function refresh()
    {
        $this->transactions = $this->transactions = Transaction::where('user_id', $this->userId)
            ->where('transaction_type', $this->type)
            ->orderBy('date', 'DESC')->get();

        $this->balance = $this->getBalance();

        $this->render();
    }

    public function render()
    {
        return view("eco-credit-module::livewire.{$this->type}s-component");
    }

    private function getBalance()
    {
        $balance = 0;

        foreach ($this->transactions as $transaction) {
            if ($transaction->type !== 'repay' && $transaction->type !== 'deposit') {
                $balance -= $transaction->amount;

                continue;
            }

            $balance += $transaction->amount;
        }

        return $balance;
    }
}
