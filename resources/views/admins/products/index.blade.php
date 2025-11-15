@extends('layouts.admins.layout-admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
<main class="app-content">

    {{-- Thông báo --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="app-title d-flex justify-content-between align-items-center mb-3">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.product.index') }}"><b>Danh sách sản phẩm</b></a>
            </li>
        </ul>
        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Thêm sản phẩm
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="tile-title">Danh sách sản phẩm</h3>
                </div>

                <div class="tile-body table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
                        <thead style="background-color: #002b5b; color: white;">
                            <tr>
                                <th>STT</th>
                                <th class="text-start">Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Size</th>
                                <th>Ảnh</th>
                                <th>Số lượng còn</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $index => $product)
                            <tr>
                                <td>{{ $products->firstItem() + $index }}</td>
                                <td class="text-start">{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '—' }}</td>
                                <td class="text-danger fw-bold">{{ number_format($product->price, 0, '.', ',') }} đ</td>
                                <td>{{ $product->size ?? '—' }}</td>
                                <td class="d-flex justify-content-center flex-wrap gap-1">
                                    @if($product->images)
                                    @foreach(explode(',', $product->images) as $img)
                                    <img src="{{ asset('storage/' . trim($img)) }}" class="rounded border"
                                        style="width:50px; height:50px; object-fit:cover;" alt="{{ $product->name }}">
                                    @endforeach
                                    @else
                                    <span class="text-muted small">Không có ảnh</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="fw-bold {{ $product->quantity > 0 ? 'text-primary' : 'text-danger' }}">
                                        {{ $product->quantity }} Chiếc
                                    </span>
                                </td>

                                <td>
                                    @if($product->is_available)
                                    <span class="badge bg-success">Đang bán</span>
                                    @else
                                    <span class="badge bg-secondary">Ngừng bán</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.product.show', $product->id) }}"
                                        class="btn btn-sm btn-info me-1" style="box-shadow:0 2px 4px rgba(0,0,0,0.1);"
                                        title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                        class="btn btn-sm btn-warning me-1"
                                        style="box-shadow:0 2px 4px rgba(0,0,0,0.1);" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Xác nhận xóa sản phẩm này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            style="box-shadow:0 2px 4px rgba(0,0,0,0.1);" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Chưa có sản phẩm nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>
</main>
@endsection