@extends('layouts.admins.layout-admin')

@section('title', 'Chọn Combo để quản lý món')

@section('content')
<main class="app-content">
    <div class="app-title mb-3">
        <h1>Chọn Combo để quản lý món</h1>
    </div>

    @if($combos->count() > 0)
    <div class="list-group">
        @foreach($combos as $combo)
        <a href="{{ route('admin.combos.items.index', $combo->id) }}" class="list-group-item list-group-item-action">
            {{ $combo->name }}
            @if($combo->products->count() > 0)
            - {{ $combo->products->count() }} món
            @endif
        </a>
        @endforeach
    </div>
    @else
    <p class="text-muted">Chưa có combo nào. Vui lòng tạo combo trước.</p>
    @endif
</main>
@endsection