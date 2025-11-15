<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Http\Requests\MenuCategoryRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Hiển thị danh sách danh mục
     */
    public function index()
    {
        $categories = MenuCategory::with(['products', 'drinks'])->paginate(10);
        return view('admins.menu.index', compact('categories'));
    }

    /**
     * Form tạo danh mục mới
     */
    public function create()
    {
        return view('admins.menu.create');
    }

    /**
     * Lưu danh mục mới
     */
    public function store(MenuCategoryRequest $request)
    {
        MenuCategory::create($request->validated());
        return redirect()->route('admin.menu.index')->with('success', 'Danh mục đã được tạo thành công.');
    }

    /**
     * Form chỉnh sửa danh mục
     */
    public function edit(MenuCategory $menu)
    {
        return view('admins.menu.edit', compact('menu'));
    }

    /**
     * Cập nhật danh mục
     */
    public function update(MenuCategoryRequest $request, MenuCategory $menu)
    {
        $menu->update($request->validated());
        return redirect()->route('admin.menu.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    /**
     * Xóa danh mục
     */
    public function destroy(MenuCategory $menu)
    {
        // Kiểm tra xem danh mục còn sản phẩm hoặc đồ uống không
        if ($menu->products()->count() > 0 || $menu->drinks()->count() > 0) {
            return redirect()->route('admin.menu.index')->with('error', 'Danh mục còn sản phẩm hoặc đồ uống, không thể xóa.');
        }

        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
