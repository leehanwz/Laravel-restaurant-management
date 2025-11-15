@extends('layouts.admins.layout-admin')

@section('title', 'Thêm sản phẩm')

@section('content')
<main class="app-content">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="tile shadow-sm p-4">

                <h3 class="tile-title mb-4"><i class="fas fa-plus me-2"></i>Thêm sản phẩm mới</h3>

                {{-- Thông báo lỗi --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Tên sản phẩm --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên sản phẩm</label>
                        <div id="product-names">
                            <input type="text" name="name[]" class="form-control mb-2" placeholder="Tên sản phẩm"
                                required>
                        </div>
                        <button type="button" id="add-name" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="fas fa-plus me-1"></i> Thêm tên khác
                        </button>
                    </div>

                    {{-- Danh mục --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Danh mục</label>
                        <select name="menu_category_id" class="form-control" required>
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Giá --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Giá</label>
                        <input type="number" name="price" class="form-control" placeholder="Giá sản phẩm" required>
                    </div>

                    {{-- Size --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Size</label>
                        <input type="text" name="size" class="form-control" placeholder="Size sản phẩm">
                    </div>

                    {{-- Mô tả --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả</label>
                        <textarea name="description" class="form-control" rows="3"
                            placeholder="Mô tả ngắn sản phẩm"></textarea>
                    </div>

                    {{-- Ảnh --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ảnh sản phẩm</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                        <div id="preview-images" class="d-flex flex-wrap gap-2 mt-2"></div>
                    </div>

                    {{-- Số lượng tồn kho --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số lượng tồn kho</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity ?? 0 }}" min="0">
                    </div>
                    
                    {{-- Trạng thái sản phẩm --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Trạng thái</label>
                        <select name="is_available" class="form-control" required>
                            <option value="1">Còn hàng</option>
                            <option value="0">Hết hàng</option>
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Quay lại
                        </a>

                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-1"></i> Thêm sản phẩm
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</main>

{{-- Script --}}
@section('scripts')
<script>
    // Thêm input tên sản phẩm
    document.getElementById('add-name').addEventListener('click', function() {
        let input = document.createElement('input');
        input.type = "text";
        input.name = "name[]";
        input.placeholder = "Tên sản phẩm";
        input.classList.add("form-control", "mb-2");
        document.getElementById('product-names').appendChild(input);
    });

    // Preview ảnh
    const inputImages = document.querySelector('input[name="images[]"]');
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
    .preview-thumb {
        transition: 0.2s ease;
        cursor: pointer;
    }

    .preview-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
        z-index: 10;
    }
</style>
@endsection

@endsection