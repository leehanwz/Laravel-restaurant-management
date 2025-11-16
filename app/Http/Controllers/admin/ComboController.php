<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CombosRequest;
use App\Models\Combos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComboController extends Controller
{
    /**
     * Hiển thị danh sách combo
     */
    public function index()
    {
        $combos = Combos::paginate(10);
        return view('admins.combos.index', compact('combos'));
    }

    /**
     * Hiển thị form tạo combo mới
     */
    public function create()
    {
        return view('admins.combos.create');
    }

    /**
     * Lưu combo mới
     */
    public function store(CombosRequest $request)
    {
        $data = $request->only(['name', 'description', 'gift_items', 'price']); // giá do admin nhập

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file->storeAs('uploads/combos', $filename, 'public');
        }

        Combos::create($data);

        return redirect()->route('admin.combos.index')
            ->with('success', 'Combo tạo thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa combo
     */
    public function edit($id)
    {
        $combo = Combos::findOrFail($id);
        return view('admins.combos.edit', compact('combo'));
    }

    /**
     * Cập nhật combo
     */
    public function update(CombosRequest $request, $id)
    {
        $combo = Combos::findOrFail($id);
        $data = $request->only(['name', 'description', 'gift_items', 'price']); // giá do admin nhập

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file->storeAs('uploads/combos', $filename, 'public');
        }

        $combo->update($data);

        return redirect()->route('admin.combos.index')
            ->with('success', 'Combo cập nhật thành công!');
    }

    /**
     * Xóa combo
     */
    public function destroy($id)
    {
        $combo = Combos::findOrFail($id);
        $combo->delete();

        return redirect()->route('admin.combos.index')
            ->with('success', 'Combo đã được xóa!');
    }

    /**
     * Hiển thị chi tiết combo (tên, ảnh, giá nhập admin)
     */
    public function show($id)
    {
        $combo = Combos::with('products')->findOrFail($id); // products optional
        return view('admins.combos.show', compact('combo'));
    }
}
