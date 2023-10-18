<?php

namespace TadgKeatingWebb\EcoCreditModule\Requests;

use App\Loan;
use Illuminate\Foundation\Http\FormRequest;


class LoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'date'  => ['required_without:id'],
            'loan_type' => ['required'],
            'amount' => ['required','numeric'],
        ];
    }
}
