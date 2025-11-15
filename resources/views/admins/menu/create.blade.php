@extends('layouts.admins.layout-admin')

@section('title', 'Thêm danh mục')

@section('content')
<main class="app-content">

    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Danh sách danh mục</a></li>
            <li class="breadcrumb-item active"><b>Thêm danh mục</b></li>
        </ul>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Thêm danh mục mới</h3>

                <form action="{{ route('admin.menu.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Nhập tên danh mục">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Loại danh mục <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                            <option value="">-- Chọn loại --</option>
                            <option value="food" {{ old('type') == 'food' ? 'selected' : '' }}>Món ăn</option>
                            <option value="drink" {{ old('type') == 'drink' ? 'selected' : '' }}>Đồ uống</option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</main>
@endsection