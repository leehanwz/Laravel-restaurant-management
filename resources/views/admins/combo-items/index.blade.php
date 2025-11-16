@extends('layouts.admins.layout-admin')

@section('title', 'Quản Lý Món trong Combo')

@section('content')
<main class="app-content">

    <div class="app-title mb-3">
        <h1>Quản Lý Món trong Combo: {{ $combo->name }}</h1>
        <a href="{{ route('admin.combos.index') }}" class="btn btn-secondary mt-2">Quay lại danh sách Combo</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form thêm món vào combo -->
    <div class="tile mb-4">
        <h5>Thêm món vào combo</h5>
        <form action="{{ route('admin.combos.items.store', $combo->id) }}" method="POST">
            @csrf
            <input type="hidden" name="combo_id" value="{{ $combo->id }}">
            <div class="row">
                <div class="col-md-6">
                    <label for="product_id" class="form-label">Chọn món</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        <option value="">-- Chọn món --</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} ({{ number_format($product->price) }} đ)
                        </option>
                        @endforeach
                    </select>
                    @error('product_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-3">
                    <label for="quantity" class="form-label">Số lượng</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                    @error('quantity')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Thêm món</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danh sách món trong combo -->
    <div class="tile">
        <h5>Món hiện có trong combo</h5>
        @if($combo->products->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên món</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($combo->products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price) }} đ</td>
                    <td>
                        <form action="{{ route('admin.combos.items.update', [$combo->id, $product->id]) }}"
                            method="POST" class="d-flex">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1"
                                class="form-control me-2" style="width:80px;">
                            <button type="submit" class="btn btn-sm btn-success">Cập nhật</button>
                        </form>
                    </td>
                    <td>{{ number_format($product->price * $product->pivot->quantity) }} đ</td>
                    <td>
                        <form action="{{ route('admin.combos.items.destroy', [$combo->id, $product->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Bạn có chắc muốn xóa món này khỏi combo?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-end fw-bold">Tổng giá combo:</td>
                    <td colspan="2" class="fw-bold text-danger">{{ number_format($combo->price) }} đ</td>
                </tr>
            </tbody>
        </table>
        @else
        <p class="text-muted">Combo chưa có món nào.</p>
        @endif
    </div>
</main>
@endsection