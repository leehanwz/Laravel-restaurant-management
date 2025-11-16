<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CombosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // cho phép tất cả, chỉnh sau nếu cần permission
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'gift_items' => 'nullable|string|max:255', // chuỗi a,b,c
            'gift_items.*' => 'string|max:255', // mỗi phần tử mảng là string
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

        ];
    }
}
