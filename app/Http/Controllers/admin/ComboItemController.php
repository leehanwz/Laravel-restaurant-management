<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ComboItemRequest;
use App\Models\Combos;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComboItemController extends Controller
{
    /**
     * Hiển thị danh sách món của một combo
     */
    public function index($comboId)
    {
        $combo = Combos::with('products')->findOrFail($comboId);

        // Lấy tất cả sản phẩm có sẵn để thêm
        $products = Product::where('is_available', 1)->get();

        // Tính tổng tiền món trong combo
        $totalPrice = $combo->products->sum(fn($p) => $p->price * $p->pivot->quantity);

        return view('admins.combo-items.index', compact('combo', 'products', 'totalPrice'));
    }

    public function selectCombo()
    {
        // Lấy tất cả combo để admin chọn trước khi vào quản lý món
        $combos = Combos::all();
        return view('admins.combo-items.select-combo', compact('combos'));
    }


    /**
     * Thêm món mới vào combo
     */
    public function store(ComboItemRequest $request)
    {
        $combo = Combos::findOrFail($request->combo_id);
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        $combo->products()->syncWithoutDetaching([
            $productId => ['quantity' => $quantity]
        ]);

        // Cập nhật giá combo
        $combo->load('products'); // load lại collection
        $combo->price = $combo->products->sum(fn($p) => $p->price * $p->pivot->quantity);

        $combo->save();

        return redirect()->route('admin.combos.items.index', $combo->id)
            ->with('success', 'Món đã thêm vào combo!');
    }

    /**
     * Cập nhật số lượng món trong combo
     */
    public function update(ComboItemRequest $request, $comboId, $productId)
    {
        $combo = Combos::findOrFail($comboId);
        $quantity = $request->quantity ?? 1;

        $combo->products()->updateExistingPivot($productId, ['quantity' => $quantity]);

        // Cập nhật giá combo
        $combo->price = $combo->products()->sum(fn($p) => $p->price * $p->pivot->quantity);
        $combo->save();

        return redirect()->route('admin.combos.items.index', $combo->id)
            ->with('success', 'Số lượng món đã được cập nhật!');
    }

    /**
     * Xóa món khỏi combo
     */
    public function destroy($comboId, $productId)
    {
        $combo = Combos::findOrFail($comboId);
        $combo->products()->detach($productId);

        // Cập nhật giá combo
        $combo->price = $combo->products()->sum(fn($p) => $p->price * $p->pivot->quantity);
        $combo->save();

        return redirect()->route('admin.combos.items.index', $combo->id)
            ->with('success', 'Món đã được xóa khỏi combo!');
    }
}
