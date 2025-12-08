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

    public function create()
    {
        return view('admins.areas.create');
    }

    public function store(AreaRequest $request)
    {
        Area::create($request->validated());

        return redirect()->route('admin.areas.index')
            ->with('success', 'Khu vực đã được thêm thành công!');
    }

    public function edit(Area $area)
    {
        return view('admins.areas.edit', compact('area'));
    }

    public function update(AreaRequest $request, Area $area)
    {
        $area->update($request->validated());

        return redirect()->route('admin.areas.index')
            ->with('success', 'Khu vực đã được cập nhật thành công!');
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('admin.areas.index')
            ->with('success', 'Khu vực đã được xóa thành công!');
    }

    public function restore($id)
    {
        $area = Area::withTrashed()->findOrFail($id);
        $area->restore();

        return redirect()->route('admin.areas.index')
            ->with('success', 'Khu vực đã được phục hồi thành công!');
    }
}
