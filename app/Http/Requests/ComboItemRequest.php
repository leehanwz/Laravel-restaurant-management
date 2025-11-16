<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComboItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'combo_id' => 'required|exists:combos,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ];
    }
}
