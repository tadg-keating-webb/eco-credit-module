<?php

namespace TadgKeatingWebb\EcoCreditModule\Livewire;

use Livewire\Component;
use TadgKeatingWebb\EcoCreditModule\Models\Transaction;

class GroupFinancialRecordComponent extends Component
{
    public string $groupJoinDate;

    public $transactions;

    // // TODO: Should this be the latest loan or the current balance?
    // public int $currentLoanSize;

    // public bool $openLoanAtPresent = false;

    public int $amountOfLoansIssued = 0;

    public int $totalLoanAmount = 0;

    public int $totalFeeAmount = 0;

    public int $totalInterestAmount = 0;

    public int $totalPenaltyAmount = 0;

    public function mount($users)
    {
        $this->transactions = Transaction::whereIn('user_id', $users->pluck('id'))
            ->where('transaction_type', 'loan')
            ->orderBy('date', 'DESC')->get();

        $this->totalLoanAmount = $this->transactions->where('type', 'loan')->sum('amount');
        $this->amountOfLoansIssued = $this->transactions->where('type', 'loan')->count();
        $this->totalFeeAmount = $this->transactions->where('type', 'fee')->sum('amount');
        $this->totalInterestAmount = $this->transactions->where('type', 'interest')->sum('amount');
        $this->totalPenaltyAmount = $this->transactions->where('type', 'penalty')->sum('amount');
    }

    public function render()
    {
        return view('eco-credit-module::livewire.group-financial-record-component');
    }
}
