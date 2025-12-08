@extends('layouts.admins.layout-admin')

@section('title', 'Quản lý Bàn Ăn')

@section('content')
<main class="app-content">

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu nhập.</div>
    @endif

    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><b>Danh sách Bàn Ăn</b></li>
        </ul>
    </div>

    <div class="row element-button mb-3">
        <div class="col-sm-2">
            <a class="btn btn-add btn-sm" href="{{ route('admin.tables.create') }}">
                <i class="fas fa-chair"></i> Thêm Bàn Ăn
            </a>
        </div>
    </div>

    <div class="container-fluid mt-3">
        @forelse ($tables as $ban)
        @php
        $badgeClass = 'bg-light text-dark';
        $trangThaiDisplay = $ban->trang_thai;
        switch (strtolower($ban->trang_thai)) {
        case 'trong': $badgeClass='bg-success'; $trangThaiDisplay='Trống'; break;
        case 'dang_phuc_vu': $badgeClass='bg-danger text-white'; $trangThaiDisplay='Đang phục vụ'; break;
        case 'da_dat': $badgeClass='bg-warning'; $trangThaiDisplay='Đã đặt'; break;
        case 'khong_su_dung': $badgeClass='bg-secondary text-white'; $trangThaiDisplay='Không sử dụng'; break;
        }
        @endphp
        <div class="col-md-2 mb-3">
            <div class="card p-2 text-center shadow-sm">
                <i class="fas fa-chair fa-2x mb-2"></i>
                <div><strong>{{ $ban->name }}</strong></div>
                <div>{{ $ban->seats }} ghế</div>
                <div>Khu vực: {{ $ban->area->name ?? 'Chưa có' }}</div>
                <span class="badge {{ $badgeClass }}">{{ $trangThaiDisplay }}</span>
                <div class="mt-2">
                    <a href="{{ route('admin.tables.edit', $ban->id) }}" class="btn btn-xs btn-outline-warning"
                        title="Sửa bàn">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.tables.destroy', $ban->id) }}" method="POST" style="display:inline;"
                        onsubmit="return confirm('Bạn có chắc muốn xóa bàn này?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-xs btn-outline-danger" title="Xóa bàn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="alert alert-info">Chưa có bàn nào.</p>
        @endforelse

        <div class="mt-3">
            {{ $tables->links() }}
        </div>
    </div>

</main>
@endsection