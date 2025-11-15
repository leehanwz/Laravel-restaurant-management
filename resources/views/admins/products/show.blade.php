@extends('layouts.admins.layout-admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<main class="app-content">
    <div class="app-title mb-3">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.index') }}">Danh sách sản phẩm</a>
            </li>
            <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="tile shadow-sm p-3">

                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h3 class="mb-0"><i class="fas fa-box-open me-2"></i>Chi tiết: {{ $product->name }}</h3>

                    <div>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm me-1">
                            <i class="fas fa-arrow-left me-1"></i> Quay lại
                        </a>
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-edit me-1"></i> Chỉnh sửa
                        </a>

                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Xác nhận xóa sản phẩm này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt me-1"></i> Xóa
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row gx-4 gy-3">
                    {{-- Left: Hình ảnh lớn + gallery --}}
                    <div class="col-md-6">
                        @php
                        $images = $product->images ? preg_split('/\s*,\s*/', trim($product->images)) : [];
                        @endphp

                        <div class="border rounded p-2 text-center bg-white">
                            @if(count($images) > 0 && $images[0] !== '')
                            <img id="main-image" src="{{ asset('storage/' . trim($images[0])) }}"
                                alt="{{ $product->name }}" class="img-fluid rounded"
                                style="max-height:420px; object-fit:contain;">
                            @else
                            <div class="py-5 text-muted">Không có ảnh sản phẩm</div>
                            @endif
                        </div>

                        {{-- Thumbnails --}}
                        @if(count($images) > 0 && $images[0] !== '')
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            @foreach($images as $img)
                            @php $img = trim($img); @endphp
                            <div class="thumb-wrapper" style="width:84px;">
                                <img src="{{ asset('storage/' . $img) }}" data-full="{{ asset('storage/' . $img) }}"
                                    alt="thumb" class="img-thumbnail thumb-img"
                                    style="width:80px; height:80px; object-fit:cover; cursor:pointer;">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    {{-- Right: Thông tin chi tiết --}}
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width:140px">Tên sản phẩm</th>
                                    <td>
                                        @php
                                        // Nếu tên lưu nhiều phần (ví dụ "A, B, C")
                                        $names = $product->name ? preg_split('/\s*,\s*/', $product->name) : [];
                                        @endphp

                                        @if(count($names) > 1)
                                        <strong>{{ $names[0] }}</strong>
                                        <div class="mt-1">
                                            @foreach($names as $i => $nm)
                                            @if($i==0) @continue @endif
                                            <span class="badge bg-light text-dark me-1">{{ $nm }}</span>
                                            @endforeach
                                        </div>
                                        @else
                                        <strong>{{ $product->name }}</strong>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Danh mục</th>
                                    <td>{{ $product->category->name ?? '—' }}</td>
                                </tr>

                                <tr>
                                    <th>Giá</th>
                                    <td class="text-danger fw-bold">
                                        {{ number_format($product->price ?? 0, 0, '.', ',') }} đ</td>
                                </tr>

                                <tr>
                                    <th>Size</th>
                                    <td>{{ $product->size ?? '—' }}</td>
                                </tr>

                                <tr>
                                    <th>Mô tả</th>
                                    <td>
                                        @if($product->description)
                                        <div style="white-space:pre-line;">{{ $product->description }}</div>
                                        @else
                                        <span class="text-muted">Chưa có mô tả</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Số lượng</th>
                                    <td>
                                        <span class="fw-bold {{ $product->quantity > 0 ? 'text-primary' : 'text-danger' }}">
                                            {{ $product->quantity }} Chiếc
                                        </span>
                                </tr>

                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        @if(isset($product->is_active) && !$product->is_active)
                                        <span class="badge bg-secondary">Không hoạt động</span>
                                        @else
                                        <span class="badge bg-success">Hoạt động</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ optional($product->created_at)->format('d/m/Y H:i') ?? '—' }}</td>
                                </tr>

                                <tr>
                                    <th>Cập nhật</th>
                                    <td>{{ optional($product->updated_at)->format('d/m/Y H:i') ?? '—' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- Additional actions or meta --}}
                        <div class="mt-3">
                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                class="btn btn-outline-primary me-2">
                                <i class="fas fa-edit me-1"></i> Chỉnh sửa
                            </a>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-light">
                                <i class="fas fa-list me-1"></i> Danh sách
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

{{-- Image modal --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <img src="" id="modal-image" class="img-fluid rounded" style="max-height:80vh; object-fit:contain;">
            </div>
        </div>
    </div>
</div>

{{-- Scripts & styles for thumbs/modal --}}
@section('scripts')
<style>
    .thumb-img {
        transition: transform .15s ease, box-shadow .15s ease;
    }

    .thumb-img:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        z-index: 5;
    }

    /* make main-image clickable */
    #main-image {
        cursor: pointer;
        transition: transform .15s ease;
    }

    #main-image:hover {
        transform: scale(1.02);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Click thumbnail -> change main image
        document.querySelectorAll('.thumb-img').forEach(function(thumb) {
            thumb.addEventListener('click', function() {
                const full = this.getAttribute('data-full');
                const main = document.getElementById('main-image');
                if (main) main.src = full;
            });

            // double click thumbnail or click to open modal
            thumb.addEventListener('dblclick', function() {
                const full = this.getAttribute('data-full');
                showImageModal(full);
            });
        });

        // Click main image -> open modal
        const mainImg = document.getElementById('main-image');
        if (mainImg) {
            mainImg.addEventListener('click', function() {
                showImageModal(this.src);
            });
        }

        function showImageModal(src) {
            const modalImg = document.getElementById('modal-image');
            modalImg.src = src;
            const modalEl = new bootstrap.Modal(document.getElementById('imageModal'));
            modalEl.show();
        }
    });
</script>
@endsection

@endsection