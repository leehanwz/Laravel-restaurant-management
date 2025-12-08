<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\Area;
use App\Http\Requests\TableRequest;

class TableController extends Controller
{
    // Hiển thị danh sách bàn riêng
    public function index()
    {
        $tables = Table::with('area')->latest()->paginate(10);
        return view('admins.tables.index', compact('tables'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('admins.tables.create', compact('areas'));
    }

    public function store(TableRequest $request)
    {
        Table::create($request->validated());

        return redirect()->route('admin.tables.index')
            ->with('success', 'Bàn đã được thêm thành công!');
    }

    public function show(Table $table)
    {
        $table->load('area');
        return view('admins.tables.show', compact('table'));
    }

    public function edit(Table $table)
    {
        $areas = Area::all();
        return view('admins.tables.edit', compact('table', 'areas'));
    }

    public function update(TableRequest $request, Table $table)
    {
        $table->update($request->validated());

        return redirect()->route('admin.tables.index')
            ->with('success', 'Bàn đã được cập nhật thành công!');
    }

    public function destroy(Table $table)
    {
        $table->delete();

        return redirect()->route('admin.tables.index')
            ->with('success', 'Bàn đã được xóa thành công!');
    }

    public function restore($id)
    {
        $table = Table::withTrashed()->findOrFail($id);
        $table->restore();

        return redirect()->route('admin.tables.index')
            ->with('success', 'Bàn đã được phục hồi thành công!');
    }
}
