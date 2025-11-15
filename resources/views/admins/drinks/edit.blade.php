@extends('layouts.admins.layout-admin')

@section('title', 'Chỉnh sửa đồ uống')

@section('content')
<main class="app-content">

    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.drink.index') }}">Danh sách đồ uống</a>
            </li>
            <li class="breadcrumb-item active">
                Chỉnh sửa đồ uống
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <h3 class="tile-title">Chỉnh sửa đồ uống</h3>

                <form action="{{ route('admin.drink.update', $drink->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Tên đồ uống --}}
                    <div class="mb-3">
                        <label>Tên đồ uống</label>
                        <input type="text" name="name" class="form-control" value="{{ $drink->name }}" required>
                    </div>

                    {{-- Danh mục --}}
                    <div class="mb-3">
                        <label>Danh mục</label>
                        <select name="menu_category_id" class="form-control" required>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $drink->menu_category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Giá --}}
                    <div class="mb-3">
                        <label>Giá</label>
                        <input type="number" name="price" class="form-control" value="{{ $drink->price }}" required>
                    </div>

                    {{-- Hương vị --}}
                    <div class="mb-3">
                        <label>Hương vị</label>
                        <input type="text" name="flavor" class="form-control" value="{{ $drink->flavor }}">
                    </div>

                    {{-- Loại --}}
                    <div class="mb-3">
                        <label>Loại</label>
                        <select name="type" class="form-control" required>
                            <option value="">Chọn loại</option>
                            <option value="Không cồn" {{ $drink->type == 'Không cồn' ? 'selected' : '' }}>Không cồn
                            </option>
                            <option value="Cồn" {{ $drink->type == 'Cồn' ? 'selected' : '' }}>Cồn</option>
                            <option value="Có ga" {{ $drink->type == 'Có ga' ? 'selected' : '' }}>Có ga</option>
                            <option value="Không ga" {{ $drink->type == 'Không ga' ? 'selected' : '' }}>Không ga
                            </option>
                        </select>
                    </div>

                    {{-- Mô tả --}}
                    <div class="mb-3">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control">{{ $drink->description }}</textarea>
                    </div>

                    {{-- Ảnh cũ --}}
                    <div class="mb-3">
                        <label>Ảnh hiện tại</label>
                        <div class="mb-2">
                            @if($drink->images)
                            @foreach(explode(',', $drink->images) as $img)
                            <div class="d-inline-block me-1 mb-1">
                                <img src="{{ asset('storage/' . $img) }}" width="80">
                                <input type="checkbox" name="existing_images[]" value="{{ $img }}" checked> Giữ
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Upload ảnh mới --}}
                    <div class="mb-3">
                        <label>Upload ảnh mới</label>
                        <input type="file" name="new_images[]" class="form-control" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật đồ uống</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection