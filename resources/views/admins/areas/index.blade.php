@extends('layouts.admins.layout-admin')

@section('title', 'Quản Lý Khu Vực')

@section('content')
<main class="app-content">

    <div class="app-title">
        <h1>Danh Sách Khu Vực</h1>
        <a href="{{ route('areas.create') }}" class="btn btn-primary">Thêm khu vực</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($areas as $kv)
    <div class="card mb-2 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $kv->name }}</strong>
                @if($kv->description) - {{ $kv->description }} @endif
            </div>
            <div>
                <a href="{{ route('areas.edit', $kv->id) }}" class="btn btn-sm btn-info">Sửa</a>
                <form action="{{ route('areas.destroy', $kv->id) }}" method="POST" style="display:inline;"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa khu vực này?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <p class="text-muted">Chưa có khu vực nào.</p>
    @endforelse

    {{ $areas->links() }}

</main>
@endsection