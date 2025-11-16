@extends('layouts.admins.layout-admin')

@section('title', 'Chi tiết Combo')

@section('content')
<main class="app-content">

    <div class="app-title mb-3">
        <h1>Chi tiết Combo: {{ $combo->name }}</h1>
        <a href="{{ route('admin.combos.index') }}" class="btn btn-secondary">Quay lại</a>
        <a href="{{ route('admin.combos.items.selectCombo', $combo->id) }}" class="btn btn-primary">
            Quản lý món trong combo
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="tile mb-3">
                <h4>Thông tin Combo</h4>
                <p><strong>Tên:</strong> {{ $combo->name }}</p>
                <p><strong>Giá:</strong> {{ number_format($combo->price, 0, ',', '.') }} đ</p>
                <p><strong>Mô tả:</strong> {{ $combo->description ?? '-' }}</p>
                <p><strong>Đồ tặng kèm:</strong>
                    @if($combo->gift_items)
                    {{ implode(', ', explode(',', $combo->gift_items)) }}
                    @else
                    -
                    @endif
                </p>
                <p><strong>Ảnh:</strong></p>
                @if($combo->image)
                <img src="{{ asset('storage/' . $combo->image) }}" alt="{{ $combo->name }}" class="img-fluid">
                @else
                <p>Chưa có ảnh</p>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="tile mb-3">
                <h4>Món trong Combo</h4>
                @if($combo->products->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên món</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($combo->products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                            <td>{{ $product->pivot->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>Combo chưa có món nào</p>
                @endif
            </div>
        </div>
    </div>

</main>
@endsection