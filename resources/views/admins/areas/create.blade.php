@extends('layouts.admins.layout-admin')

@section('title', 'Tạo Khu Vực Mới')

@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.areas.index') }}">Quản lý Khu Vực</a>
            </li>
            <li class="breadcrumb-item"><b>Tạo Khu Vực Mới</b></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tạo Khu Vực Mới</h3>

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

                    <form class="row" method="POST" action="{{ route('admin.areas.store') }}">
                        @csrf

                        <div class="form-group col-md-6">
                            <label class="control-label">Tên Khu Vực (*)</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Mô Tả</label>
                            <input class="form-control" type="text" name="description" value="{{ old('description') }}">
                        </div>

                        <div class="form-group col-md-12">
                            <button class="btn btn-save" type="submit">Lưu lại</button>
                            <a class="btn btn-cancel" href="{{ route('admin.areas.index') }}">Hủy bỏ</a>
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