@extends('layouts.admins.layout-admin')

@section('title', 'Tạo Bàn Ăn Mới')

@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.tables.index') }}">Quản lý Bàn Ăn</a>
            </li>
            <li class="breadcrumb-item"><b>Tạo Bàn Ăn Mới</b></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tạo Bàn Ăn Mới</h3>

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

                    <form class="row" method="POST" action="{{ route('admin.tables.store') }}">
                        @csrf

                        <div class="form-group col-md-6">
                            <label class="control-label">Khu Vực (*)</label>
                            <select class="form-control" name="area_id" required>
                                <option value="">-- Chọn Khu Vực --</option>
                                @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                    {{ $area->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Tên Bàn (*)</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Số Ghế (*)</label>
                            <input class="form-control" type="number" name="seats" min="1" value="{{ old('seats', 2) }}"
                                required>
                        </div>

                        <div class="form-group col-md-12">
                            <button class="btn btn-save" type="submit">Lưu lại</button>
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