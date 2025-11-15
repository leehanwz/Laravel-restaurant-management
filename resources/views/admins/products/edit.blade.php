@extends('layouts.admins.layout-admin')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
<main class="app-content">

    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.index') }}">Danh sách sản phẩm</a>
            </li>
            <li class="breadcrumb-item active">
                Chỉnh sửa sản phẩm
            </li>
        </ul>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tile shadow-sm p-4">

                <h3 class="tile-title mb-4"><i class="fas fa-edit me-2"></i>Chỉnh sửa sản phẩm</h3>

                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Tên sản phẩm --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên sản phẩm</label>
                        <div id="product-names">
                            @foreach(explode(', ', $product->name) as $n)
                                <input type="text" name="name[]" class="form-control mb-2" value="{{ $n }}">
                            @endforeach
                        </div>
                        <button type="button" id="add-name" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="fas fa-plus me-1"></i> Thêm tên khác
                        </button>
                    </div>

                    {{-- Danh mục --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Danh mục</label>
                        <select name="menu_category_id" class="form-control" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->menu_category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Giá --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Giá</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}" min="0" required>
                    </div>

                    {{-- Size --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Size</label>
                        <input type="text" name="size" class="form-control" value="{{ $product->size }}">
                    </div>

                    {{-- Mô tả --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả</label>
                        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                    </div>

                    {{-- Ảnh cũ --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ảnh hiện tại</label>
                        <div class="d-flex flex-wrap gap-3 mt-2">
                            @foreach(explode(',', $product->images) as $img)
                                <div class="border p-2 rounded shadow-sm position-relative text-center" style="width: 110px;">
                                    <img src="{{ asset('storage/' . trim($img)) }}" class="rounded mb-1 preview-old" style="width: 100%; height: 80px; object-fit: cover;">
                                    <div class="form-check mt-1 text-center">
                                        <input class="form-check-input" type="checkbox" name="existing_images[]" value="{{ trim($img) }}" checked>
                                        <label class="form-check-label small">Giữ</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Ảnh mới --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload ảnh mới</label>
                        <input type="file" name="new_images[]" class="form-control" multiple accept="image/*">
                        <div id="preview-images" class="d-flex flex-wrap gap-2 mt-2"></div>
                    </div>

                    {{-- Số lượng tồn kho --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số lượng tồn kho</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity ?? 0 }}" min="0" required>
                        <small class="text-muted">Số lượng > 0 sẽ tự động bật trạng thái "Còn hàng".</small>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-1"></i> Cập nhật sản phẩm
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</main>

{{-- Scripts --}}
@section('scripts')
<script>
document.getElementById('add-name').addEventListener('click', function() {
    let input = document.createElement('input');
    input.type = "text";
    input.name = "name[]";
    input.placeholder = "Tên sản phẩm";
    input.classList.add("form-control", "mb-2");
    document.getElementById('product-names').appendChild(input);
});

const inputImages = document.querySelector('input[name="new_images[]"]');
const previewContainer = document.getElementById('preview-images');

inputImages.addEventListener('change', function () {
    previewContainer.innerHTML = '';
    Array.from(this.files).forEach(file => {
        let reader = new FileReader();
        reader.onload = e => {
            let img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('rounded', 'border', 'shadow-sm', 'preview-thumb');
            img.style.width = '80px';
            img.style.height = '80px';
            img.style.objectFit = 'cover';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>

<style>
.preview-thumb, .preview-old {
    transition: 0.2s ease;
    cursor: pointer;
}
.preview-thumb:hover, .preview-old:hover {
    transform: scale(1.15);
    box-shadow: 0 0 6px rgba(0,0,0,0.3);
    z-index: 10;
}
</style>
@endsection

@endsection
