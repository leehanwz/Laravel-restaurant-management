@extends('layouts.admins.layout-admin')

@section('title', 'Tạo Combo mới')

@section('content')
<main class="app-content">
    <div class="app-title mb-3">
        <h1>Tạo Combo mới</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <form action="{{ route('admin.combos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Combo <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            required>
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea name="description" id="description"
                            class="form-control">{{ old('description') }}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="gift_items" class="form-label">Đồ tặng kèm (cách nhau dấu phẩy)</label>
                        <input type="text" name="gift_items" id="gift_items" class="form-control"
                            value="{{ old('gift_items') }}">
                        @error('gift_items')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh combo</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá combo</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                            required>
                        @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tạo Combo</button>
                    <a href="{{ route('admin.combos.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection