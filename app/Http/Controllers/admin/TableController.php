<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\Area;
use App\Http\Requests\TableRequest;

class TableController extends Controller
{
    /**
     * Hiển thị danh sách bàn (có pagination)
     */
    public function index()
    {
        $tables = Table::with('area')->latest()->paginate(10); // Eager load area
        return view('admins.khu-vuc-ban-an', compact('tables'));
    }

    /**
     * Hiển thị form thêm bàn mới
     */
    public function create()
    {
        $areas = Area::all(); // Lấy tất cả khu vực để chọn
        return view('admins.tables.create', compact('areas'));
    }

    /**
     * Lưu bàn mới vào database
     */
    public function store(TableRequest $request)
    {
        Table::create($request->validated());

        return redirect()->route('admin.tables.index')
            ->with('success', 'Bàn đã được thêm thành công!');
    }

    /**
     * Hiển thị chi tiết bàn
     */
    public function show(Table $table)
    {
        $table->load('area'); // Lấy thông tin khu vực
        return view('admins.tables.show', compact('table'));
    }

    /**
     * Hiển thị form chỉnh sửa bàn
     */
    public function edit(Table $table)
    {
        $areas = Area::all();
        return view('admins.tables.edit', compact('table', 'areas'));
    }

    /**
     * Cập nhật bàn
     */
    public function update(TableRequest $request, Table $table)
    {
        $table->update($request->validated());

        return redirect()->route('admin.tables.index')
            ->with('success', 'Bàn đã được cập nhật thành công!');
    }

    /**
     * Xóa mềm bàn
     */
    public function destroy(Table $table)
    {
        $table->delete(); // Soft Delete

        return redirect()->route('admin.tables.index')
            ->with('success', 'Bàn đã được xóa thành công!');
    }

    /**
     * Phục hồi bàn đã xóa mềm
     */
    public function restore($id)
    {
        $table = Table::withTrashed()->findOrFail($id);
        $table->restore();

        return redirect()->route('admin.tables.index')
            ->with('success', 'Bàn đã được phục hồi thành công!');
    }
}
