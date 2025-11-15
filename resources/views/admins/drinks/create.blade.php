@extends('layouts.admins.layout-admin')

@section('title', 'Thêm mới đồ uống')

@section('content')
<main class="app-content">

    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.drink.index') }}">Danh sách đồ uống</a>
            </li>
            <li class="breadcrumb-item active">
                Thêm mới đồ uống
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <h3 class="tile-title">Thêm mới đồ uống</h3>

                <form action="{{ route('admin.drink.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Tên đồ uống --}}
                    <div class="mb-3">
                        <label>Tên đồ uống</label>
                        <input type="text" name="name" class="form-control" placeholder="Tên đồ uống" required>
                    </div>

                    {{-- Danh mục --}}
                    <div class="mb-3">
                        <label>Danh mục</label>
                        <select name="menu_category_id" class="form-control" required>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Giá --}}
                    <div class="mb-3">
                        <label>Giá</label>
                        <input type="number" name="price" class="form-control" placeholder="Giá" required>
                    </div>

                    {{-- Hương vị --}}
                    <div class="mb-3">
                        <label>Hương vị</label>
                        <input type="text" name="flavor" class="form-control" placeholder="Ví dụ: Chanh, Dâu...">
                    </div>

                    {{-- Loại --}}
                    <div class="mb-3">
                        <label>Loại</label>
                        <select name="type" class="form-control" required>
                            <option value="">Chọn loại</option>
                            <option value="Không cồn">Không cồn</option>
                            <option value="Cồn">Cồn</option>
                            <option value="Có ga">Có ga</option>
                            <option value="Không ga">Không ga</option>
                        </select>
                    </div>

                    {{-- Mô tả --}}
                    <div class="mb-3">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    {{-- Upload ảnh --}}
                    <div class="mb-3">
                        <label>Upload ảnh</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm đồ uống</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection