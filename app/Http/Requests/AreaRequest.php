<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Nếu có middleware kiểm quyền thì không cần check ở đây
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên khu vực không được để trống.',
            'name.string' => 'Tên khu vực phải là chuỗi ký tự.',
            'name.max' => 'Tên khu vực không được vượt quá 100 ký tự.',
            'description.string' => 'Mô tả khu vực phải là chuỗi ký tự.',
            'description.max' => 'Mô tả khu vực không được vượt quá 1000 ký tự.',
        ];
    }
}
