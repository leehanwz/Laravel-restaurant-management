<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\MenuCategory;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('admins.products.index', compact('products'));
    }

    public function create()
    {
        $categories = MenuCategory::where('type', 'food')->get();
        return view('admins.products.create', compact('categories'));
    }

    public function show(Product $product)
    {
        return view('admins.products.show', compact('product'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        // Ghép name nếu là mảng
        if (isset($data['name']) && is_array($data['name'])) {
            $data['name'] = implode(', ', $data['name']);
        }

        // Số lượng
        $data['quantity'] = $request->input('quantity', 0);

        // Auto logic: quantity > 0 => còn hàng, ngược lại hết hàng
        $data['is_available'] = $data['quantity'] > 0 ? 1 : 0;

        // Upload ảnh
        $uploadedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $uploadedImages[] = $file->store('products', 'public');
            }
        }
        $data['images'] = implode(',', $uploadedImages);

        Product::create($data);

        return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }
    public function edit(Product $product)
    {
        $categories = MenuCategory::where('type', 'food')->get();
        return view('admins.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // Ghép name nếu là mảng
        if (isset($data['name']) && is_array($data['name'])) {
            $data['name'] = implode(', ', $data['name']);
        }

        // Lấy số lượng
        $data['quantity'] = $request->input('quantity', $product->quantity);

        // Auto logic: quantity > 0 => còn hàng, ngược lại hết hàng
        $data['is_available'] = $data['quantity'] > 0 ? 1 : 0;

        // Xử lý ảnh cũ
        $existingImages = $request->input('existing_images', []);
        if (!is_array($existingImages)) $existingImages = [];
        $oldImages = $product->images ? explode(',', $product->images) : [];
        foreach ($oldImages as $img) {
            if (!in_array($img, $existingImages)) {
                Storage::disk('public')->delete($img);
            }
        }

        // Upload ảnh mới
        $newImages = [];
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $newImages[] = $file->store('products', 'public');
            }
        }

        $data['images'] = implode(',', array_merge($existingImages, $newImages));

        $product->update($data);

        return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
    public function destroy(Product $product)
    {
        $images = $product->images ? explode(',', $product->images) : [];
        foreach ($images as $img) {
            Storage::disk('public')->delete($img);
        }

        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
