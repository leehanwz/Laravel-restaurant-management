<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
{
    /**
     * Kiểm tra quyền thực hiện request
     */
    public function authorize(): bool
    {
        return true; // Nếu muốn, có thể kiểm tra role ở đây
    }

    /**
     * Rules cho cả store và update
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'area_id' => 'required|exists:areas,id',
            'seats' => 'required|integer|min:1',
        ];
    }

    /**
     * Custom messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên bàn không được để trống.',
            'name.string' => 'Tên bàn phải là chuỗi ký tự.',
            'name.max' => 'Tên bàn không được vượt quá 50 ký tự.',

            'area_id.required' => 'Bạn phải chọn khu vực cho bàn.',
            'area_id.exists' => 'Khu vực được chọn không tồn tại.',

            'seats.required' => 'Số ghế không được để trống.',
            'seats.integer' => 'Số ghế phải là số nguyên.',
            'seats.min' => 'Số ghế phải lớn hơn hoặc bằng 1.',
        ];
    }
}
