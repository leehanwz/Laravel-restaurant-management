@extends('layouts.admins.layout-admin')

@section('title', 'Quản lý Khu Vực & Bàn Ăn')

@section('content')
<main class="app-content">

    {{-- THÔNG BÁO --}}
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu nhập.</div>
    @endif

    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><b>Quản lý Khu Vực & Bàn Ăn</b></li>
        </ul>
    </div>

    <div class="row element-button mb-3">
        <div class="col-sm-2">
            <a class="btn btn-add btn-sm" href="{{ route('admin.areas.create') }}">
                <i class="fas fa-building"></i> Thêm Khu Vực
            </a>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-add btn-sm" href="{{ route('admin.tables.create') }}">
                <i class="fas fa-chair"></i> Thêm Bàn Ăn
            </a>
        </div>
    </div>

    <div class="container-fluid mt-3">
        @forelse ($khuVucs as $kv)
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-building mr-2"></i> {{ $kv->name }}
                    @if($kv->description) - {{ $kv->description }} @endif
                </h5>
                <div>
                    <a href="{{ route('admin.areas.edit', $kv->id) }}" class="btn btn-sm btn-info" title="Sửa Khu Vực">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.areas.destroy', $kv->id) }}" method="POST" style="display:inline;"
                        onsubmit="return confirm('Bạn có chắc muốn xóa khu vực này? (Phải xóa hết bàn trước)');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($kv->tables as $ban)
                    @php
                    $badgeClass = 'bg-light text-dark';
                    $trangThaiDisplay = $ban->trang_thai;
                    switch (strtolower($ban->trang_thai)) {
                    case 'trong': $badgeClass='bg-success'; $trangThaiDisplay='Trống'; break;
                    case 'dang_phuc_vu': $badgeClass='bg-danger text-white'; $trangThaiDisplay='Đang phục vụ'; break;
                    case 'da_dat': $badgeClass='bg-warning'; $trangThaiDisplay='Đã đặt'; break;
                    case 'khong_su_dung': $badgeClass='bg-secondary text-white'; $trangThaiDisplay='Không sử dụng';
                    break;
                    }
                    @endphp
                    <div class="col-md-2 mb-3">
                        <div class="card p-2 text-center shadow-sm">
                            <i class="fas fa-chair fa-2x mb-2"></i>
                            <div><strong>{{ $ban->name }}</strong></div>
                            <div>{{ $ban->seats }} ghế</div>
                            <span class="badge {{ $badgeClass }}">{{ $trangThaiDisplay }}</span>
                            <div class="mt-2">
                                <a href="{{ route('admin.tables.edit', $ban->id) }}" class="btn btn-xs btn-outline-warning"
                                    title="Sửa bàn">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.tables.destroy', $ban->id) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa bàn này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-xs btn-outline-danger" title="Xóa bàn">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                {{-- Nếu có QR code --}}
                                {{-- <form action="{{ route('ban-an.qr', $ban->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="btn btn-xs btn-outline-info" title="Tạo lại QR">
                                        <i class="fas fa-qrcode"></i>
                                    </button>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <p class="text-muted">Chưa có bàn nào trong khu vực này.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="alert alert-info">Chưa có khu vực nào được tạo.</p>
        </div>
        @endforelse
    </div>

</main>
@endsection

@section('script')
@endsection