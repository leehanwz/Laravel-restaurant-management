@extends('layouts.admins.layout-admin')

@section('title', 'Danh sách đồ uống')

@section('content')
<main class="app-content">

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.drink.index') }}"><b>Danh sách đồ uống</b></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="tile-title">Danh sách đồ uống</h3>
                    <a href="{{ route('admin.drink.create') }}" class="btn btn-add btn-sm">
                        <i class="fas fa-plus me-2"></i> Thêm đồ uống
                    </a>
                </div>

                <div class="tile-body">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
                        <thead style="background-color: #002b5b; color: white;">
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Hương vị</th>
                                <th>Type</th>
                                <th>Ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($drinks as $index => $drink)
                            <tr>
                                <td>{{ $drinks->firstItem() + $index }}</td>
                                <td class="text-start">{{ $drink->name }}</td>
                                <td>{{ $drink->category->name ?? '—' }}</td>
                                <td>{{ number_format($drink->price, 0, '.', ',') }} đ</td>
                                <td>{{ $drink->flavor ?? '—' }}</td>
                                <td>{{ $drink->type ?? '—' }}</td>
                                <td>
                                    @if($drink->images)
                                    @foreach(explode(',', $drink->images) as $img)
                                    <img src="{{ asset('storage/' . $img) }}" width="50" class="me-1 mb-1">
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.drink.edit', $drink->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.drink.destroy', $drink->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Xác nhận xóa đồ uống này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Chưa có đồ uống nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $drinks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection