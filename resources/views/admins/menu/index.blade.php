@extends('layouts.admins.layout-admin')

@section('title', 'Danh sách danh mục')

@section('content')
<main class="app-content">

    {{-- Thông báo success / error --}}
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.menu.index') }}"><b>Danh sách danh mục</b></a>
            </li>
        </ul>
        <div id="clock"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="tile-title">Danh sách danh mục</h3>
                    <a href="{{ route('admin.menu.create') }}" class="btn btn-add btn-sm">
                        <i class="fas fa-plus me-2"></i> Thêm danh mục
                    </a>
                </div>

                <div class="tile-body">
                    <div class="rounded overflow-hidden">
                        <table class="table table-bordered table-hover align-middle text-center mb-0" id="menuTable">
                            <thead style="background-color: #002b5b; color: white;">
                                <tr>
                                    <th>#</th>
                                    <th>Tên danh mục</th>
                                    <th>Loại</th>
                                    <th>Số sản phẩm</th>
                                    <th>Số đồ uống</th>
                                    <th style="width: 100px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $index => $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $index }}</td>
                                    <td class="text-start">{{ $category->name }}</td>
                                    <td>{{ ucfirst($category->type) }}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td>{{ $category->drinks->count() }}</td>
                                    <td>
                                        <a href="{{ route('admin.menu.edit', $category->id) }}"
                                            class="btn btn-sm btn-warning" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.menu.destroy', $category->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Xác nhận xóa danh mục này?')">
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
                                    <td colspan="6" class="text-center text-muted">Chưa có danh mục nào</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="d-flex justify-content-center mt-3">
                        {{ $categories->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection