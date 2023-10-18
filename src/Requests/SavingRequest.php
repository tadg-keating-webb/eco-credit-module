<?php

namespace TadgKeatingWebb\EcoCreditModule\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'date'  => ['required_without:id'],
            'saving_type' => ['required'],
            'amount' => ['required', 'numeric'],
        ];
    }
}
