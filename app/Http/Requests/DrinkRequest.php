<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'flavor' => 'nullable|string|max:100',
            'type' => 'nullable|string|max:100', // cồn/không cồn, có ga/không ga
            'images' => 'nullable|array',
            'images.*' => 'string|max:255',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'menu_category_id.required' => 'Danh mục đồ uống bắt buộc chọn.',
            'menu_category_id.exists' => 'Danh mục đồ uống không tồn tại.',
            'name.required' => 'Tên đồ uống không được để trống.',
            'name.string' => 'Tên đồ uống phải là chuỗi ký tự.',
            'name.max' => 'Tên đồ uống không được vượt quá 255 ký tự.',
            'price.required' => 'Giá đồ uống bắt buộc nhập.',
            'price.numeric' => 'Giá đồ uống phải là số.',
            'price.min' => 'Giá đồ uống không được nhỏ hơn 0.',
            'flavor.max' => 'Vị đồ uống không vượt quá 100 ký tự.',
            'type.max' => 'Loại đồ uống không vượt quá 100 ký tự.',
            'images.array' => 'Ảnh đồ uống phải là mảng.',
            'images.*.string' => 'Đường dẫn ảnh phải là chuỗi ký tự.',
            'images.*.max' => 'Đường dẫn ảnh không được vượt quá 255 ký tự.',
            'description.max' => 'Mô tả đồ uống không vượt quá 1000 ký tự.',
        ];
    }
}
