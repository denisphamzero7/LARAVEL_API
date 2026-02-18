@extends('layouts.admin')
@section('title','Chỉnh sửa nhóm')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa nhóm</h1>
    </div>
    @if($errors->any())
    <div class="alert alert-danger text-center">Vui lòng nhập đủ thông tin</div>
    @endif

    {{-- Sửa action truyền vào $group --}}
    <form action="{{route('admin.groups.edit', $group)}}" method="post">
        @csrf
        @method('PUT') {{-- Bắt buộc phải có để khớp với Route::put --}}

        <div class="mb-3">
            <label for="">Tên nhóm</label>
            {{-- Sửa lại cú pháp old: tham số thứ 2 là giá trị mặc định --}}
            <input type="text" name="name" class="form-control" placeholder="Tên" value="{{ old('name', $group->name) }}">

            @error('name')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật nhóm</button>
    </form>
@endsection
