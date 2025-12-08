@extends('layouts.admins.layout-admin')

@section('title', 'Chỉnh Sửa Bàn Ăn')

@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.tables.index') }}">Quản lý Bàn Ăn</a>
            </li>
            <li class="breadcrumb-item"><b>Chỉnh Sửa Bàn Ăn</b></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Chỉnh Sửa Bàn Ăn</h3>

                <div class="tile-body">
                    {{-- Hiển thị lỗi Validation --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Hiển thị lỗi DB --}}
                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form class="row" method="POST" action="{{ route('admin.tables.update', $table->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group col-md-6">
                            <label class="control-label">Khu Vực (*)</label>
                            <select class="form-control" name="area_id" required>
                                <option value="">-- Chọn Khu Vực --</option>
                                @foreach ($areas as $area)
                                <option value="{{ $area->id }}"
                                    {{ old('area_id', $table->area_id) == $area->id ? 'selected' : '' }}>
                                    {{ $area->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Tên Bàn (*)</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name', $table->name) }}"
                                required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Số Ghế (*)</label>
                            <input class="form-control" type="number" name="seats" min="1"
                                value="{{ old('seats', $table->seats) }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Trạng Thái Bàn (*)</label>
                            <select class="form-control" name="trang_thai" required>
                                <option value="trong"
                                    {{ old('trang_thai', $table->trang_thai) == 'trong' ? 'selected' : '' }}>
                                    Trống
                                </option>
                                <option value="da_dat_chua_den"
                                    {{ old('trang_thai', $table->trang_thai) == 'da_dat_chua_den' ? 'selected' : '' }}>
                                    Khách đã đặt, chưa đến
                                </option>
                                <option value="phuc_vu"
                                    {{ old('trang_thai', $table->trang_thai) == 'phuc_vu' ? 'selected' : '' }}>
                                    Khách đang phục vụ
                                </option>
                                <option value="da_xong"
                                    {{ old('trang_thai', $table->trang_thai) == 'da_xong' ? 'selected' : '' }}>
                                    Đã xong
                                </option>
                                <option value="khong_su_dung"
                                    {{ old('trang_thai', $table->trang_thai) == 'khong_su_dung' ? 'selected' : '' }}>
                                    Không sử dụng
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-12 mt-3">
                            <button class="btn btn-save" type="submit">Cập nhật</button>
                            <a class="btn btn-cancel" href="{{ route('admin.tables.index') }}">Hủy bỏ</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
@endsection