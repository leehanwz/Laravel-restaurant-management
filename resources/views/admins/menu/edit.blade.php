@extends('layouts.admins.layout-admin')

@section('title', 'Chỉnh sửa danh mục')

@section('content')
<main class="app-content">

    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Danh sách danh mục</a></li>
            <li class="breadcrumb-item active"><b>Chỉnh sửa danh mục</b></li>
        </ul>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Chỉnh sửa danh mục</h3>

                <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $menu->name) }}" placeholder="Nhập tên danh mục">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Loại danh mục <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                            <option value="">-- Chọn loại --</option>
                            <option value="food" {{ old('type', $menu->type) == 'food' ? 'selected' : '' }}>Món ăn
                            </option>
                            <option value="drink" {{ old('type', $menu->type) == 'drink' ? 'selected' : '' }}>Đồ uống
                            </option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</main>
@endsection