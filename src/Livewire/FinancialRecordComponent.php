<?php

namespace TadgKeatingWebb\EcoCreditModule\Livewire;

use Livewire\Component;
use TadgKeatingWebb\EcoCreditModule\Models\Transaction;

class FinancialRecordComponent extends Component
{
    private int $userId;

    public string $joinDate;

    public $transactions;

    // TODO: Should this be the latest loan or the current balance?
    public int $currentLoanSize;

    public bool $openLoanAtPresent = false;

    public int $amountOfLoansIssued = 0;

    public int $totalLoanAmount = 0;

    public int $totalFeeAmount = 0;

    public int $totalInterestAmount = 0;

    public int $totalPenaltyAmount = 0;

    public function mount(int $userId)
    {
        $this->userId = $userId;

        $this->setup();
    }

    public function render()
    {
        return view('eco-credit-module::livewire.financial-record-component');
    }

    private function setup()
    {
        $this->transactions = $this->transactions = Transaction::where('user_id', $this->userId)
            ->where('transaction_type', 'loan')
            ->orderBy('date', 'DESC')->get();

        $this->currentLoanSize = $this->getBalance();

        if ($this->currentLoanSize < 0) {
            $this->openLoanAtPresent = true;
        }

        $this->amountOfLoansIssued = $this->transactions->where('type', 'loan')->count();

        $this->totalLoanAmount = $this->transactions->where('type', 'loan')->sum('amount');

        $this->totalFeeAmount = $this->transactions->where('type', 'fee')->sum('amount');

        $this->totalInterestAmount = $this->transactions->where('type', 'interest')->sum('amount');

        $this->totalPenaltyAmount = $this->transactions->where('type', 'penalty')->sum('amount');
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
