<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drink;
use App\Models\MenuCategory;
use App\Http\Requests\DrinkRequest;
use Illuminate\Support\Facades\Storage;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::with('category')->paginate(10);
        return view('admins.drinks.index', compact('drinks'));
    }

    public function create()
    {
        $categories = MenuCategory::where('type', 'drink')->get();
        return view('admins.drinks.create', compact('categories'));
    }

    public function store(DrinkRequest $request)
    {
        $data = $request->validated();

        // Nếu name gửi dưới dạng mảng, ghép thành string
        if (is_array($data['name'])) {
            $data['name'] = implode(', ', $data['name']);
        }

        // Upload ảnh
        $uploadedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $uploadedImages[] = $file->store('drinks', 'public');
            }
        }
        $data['images'] = implode(',', $uploadedImages); // lưu thành string

        Drink::create($data);

        return redirect()->route('admin.drink.index')->with('success', 'Đồ uống đã được tạo thành công.');
    }

    public function edit(Drink $drink)
    {
        $categories = MenuCategory::all();
        return view('admins.drinks.edit', compact('drink', 'categories'));
    }

    public function update(DrinkRequest $request, Drink $drink)
    {
        $data = $request->validated();

        if (is_array($data['name'])) {
            $data['name'] = implode(', ', $data['name']);
        }

        // Lấy existing images
        $existingImages = $request->input('existing_images', []);
        if (!is_array($existingImages)) {
            $existingImages = [];
        }

        // Xóa ảnh cũ không còn giữ
        $oldImages = $drink->images ? explode(',', $drink->images) : [];
        foreach ($oldImages as $img) {
            if (!in_array($img, $existingImages)) {
                Storage::disk('public')->delete($img);
            }
        }

        // Upload ảnh mới
        $newImages = [];
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $newImages[] = $file->store('drinks', 'public');
            }
        }

        $data['images'] = implode(',', array_merge($existingImages, $newImages));

        $drink->update($data);

        return redirect()->route('admin.drink.index')->with('success', 'Đồ uống đã được cập nhật thành công.');
    }

    public function destroy(Drink $drink)
    {
        $oldImages = $drink->images ? explode(',', $drink->images) : [];
        foreach ($oldImages as $img) {
            Storage::disk('public')->delete($img);
        }

        $drink->delete();

        return redirect()->route('admin.drink.index')->with('success', 'Đồ uống đã được xóa thành công.');
    }
}
