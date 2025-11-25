<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Http\Requests\AreaRequest;

class AreaController extends Controller
{
    // Dashboard tổng hợp khu vực + bàn
    public function dashboard()
    {
        $khuVucs = Area::with('tables')->get(); // eager load bàn ăn
        return view('admins.khu-vuc-ban-an', compact('khuVucs'));
    }

    // Index: liệt kê khu vực
    public function index()
    {
        $areas = Area::latest()->paginate(10);
        return view('admins.areas.index', compact('areas'));
    }

    // Form tạo khu vực
    public function create()
    {
        return view('admins.areas.create');
    }

    // Lưu khu vực mới
    public function store(AreaRequest $request)
    {
        Area::create($request->validated());

        return redirect()->route('admin.areas.index')
            ->with('success', 'Khu vực đã được thêm thành công!');
    }

    // Form sửa khu vực
    public function edit(Area $area)
    {
        return view('admins.areas.edit', compact('area'));
    }

    // Cập nhật khu vực
    public function update(AreaRequest $request, Area $area)
    {
        $area->update($request->validated());

        return redirect()->route('admin.areas.index')
            ->with('success', 'Khu vực đã được cập nhật thành công!');
    }

    // Xóa khu vực (soft delete)
    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('admin.areas.index')
            ->with('success', 'Khu vực đã được xóa thành công!');
    }

    // Khôi phục khu vực đã xóa
    public function restore($id)
    {
        $area = Area::withTrashed()->findOrFail($id);
        $area->restore();

        return redirect()->route('admin.areas.index')
            ->with('success', 'Khu vực đã được phục hồi thành công!');
    }
}
