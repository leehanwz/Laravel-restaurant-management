@extends('layouts.admins.layout-admin')

@section('title', 'Danh sách Combo')

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
                <b>Danh sách Combo</b>
            </li>
        </ul>
        <a href="{{ route('admin.combos.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Thêm Combo
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="tile-title">Danh sách Combo</h3>
                </div>

                <div class="tile-body table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
                        <thead style="background-color: #002b5b; color: white;">
                            <tr>
                                <th>STT</th>
                                <th class="text-start">Tên Combo</th>
                                <th>Món trong combo</th>
                                <th>Đồ tặng kèm</th>
                                <th>Giá</th>
                                <th>Ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($combos as $index => $combo)
                            <tr>
                                <td>{{ $combos->firstItem() + $index }}</td>
                                <td class="text-start">{{ $combo->name }}</td>
                                <td class="text-start">
                                    @if($combo->products->count())
                                    {{ $combo->products->pluck('name')->implode(', ') }}
                                    @else
                                    <span class="text-muted">Chưa có món</span>
                                    @endif
                                </td>
                                <td>
                                    @if($combo->gift_items)
                                    {{ implode(', ', explode(',', $combo->gift_items)) }}
                                    @else
                                    <span class="text-muted">Không</span>
                                    @endif
                                </td>
                                <td class="text-danger fw-bold">{{ number_format($combo->price ?? 0, 0, '.', ',') }} đ
                                </td>
                                <td>
                                    @if($combo->image)
                                    <img src="{{ asset('storage/' . $combo->image) }}" alt="{{ $combo->name }}"
                                        class="rounded" style="width:50px; height:50px; object-fit:cover;">
                                    @else
                                    <span class="text-muted small">Không có ảnh</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.combos.show', $combo->id) }}" class="btn btn-sm btn-info me-1"
                                        title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.combos.edit', $combo->id) }}" class="btn btn-sm btn-warning me-1"
                                        title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.combos.destroy', $combo->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Xác nhận xóa combo này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Chưa có combo nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $combos->links() }}
                </div>

            </div>
        </div>
    </div>
</main>
@endsection