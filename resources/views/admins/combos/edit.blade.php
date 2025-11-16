@extends('layouts.admins.layout-admin')

@section('title', 'Chỉnh sửa Combo')

@section('content')
<main class="app-content">
    <div class="app-title mb-3">
        <h1>Chỉnh sửa Combo</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <form action="{{ route('admin.combos.update', $combo->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Combo <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $combo->name) }}" required>
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea name="description" id="description"
                            class="form-control">{{ old('description', $combo->description) }}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="gift_items" class="form-label">Đồ tặng kèm</label>
                        <input type="text" name="gift_items" id="gift_items" class="form-control"
                            value="{{ old('gift_items', $combo->gift_items) }}">
                        @error('gift_items')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh combo</label>
                        @if($combo->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$combo->image) }}" alt="{{ $combo->name }}" width="150">
                        </div>
                        @endif
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá combo</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ old('price', $combo->price) }}" required>
                        @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật Combo</button>
                    <a href="{{ route('admin.combos.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection