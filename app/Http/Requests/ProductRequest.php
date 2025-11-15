<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|array|min:1',
            'name.*' => 'string|max:255',
            'price' => 'required|numeric|min:0',
            'new_images.*' => 'file|image|max:5120', // 5MB max, cho upload ảnh mới
            'existing_images.*' => 'string|max:255', // tên file cũ, có thể sửa
            'size' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'is_available' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'menu_category_id.required' => 'Danh mục món ăn bắt buộc chọn.',
            'menu_category_id.exists' => 'Danh mục món ăn không tồn tại.',
            'name.required' => 'Tên món ăn không được để trống.',
            'name.array' => 'Tên món ăn phải là mảng.',
            'name.*.string' => 'Tên món ăn phải là chuỗi ký tự.',
            'name.*.max' => 'Tên món ăn không được vượt quá 255 ký tự.',
            'price.required' => 'Giá món ăn bắt buộc nhập.',
            'price.numeric' => 'Giá món ăn phải là số.',
            'price.min' => 'Giá món ăn không được nhỏ hơn 0.',
            'new_images.*.image' => 'File phải là ảnh.',
            'new_images.*.max' => 'Ảnh không được vượt quá 5MB.',
            'size.max' => 'Size món không vượt quá 50 ký tự.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'is_available.boolean' => 'Trạng thái món phải là true hoặc false.',
        ];
    }
}
