<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép mọi user (sau này dùng middleware phân quyền)
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:food,drink', // phân loại danh mục
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục không được để trống.',
            'name.string' => 'Tên danh mục phải là chuỗi ký tự.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'type.required' => 'Loại danh mục bắt buộc chọn.',
            'type.in' => 'Loại danh mục phải là "food" hoặc "drink".',
        ];
    }
}
