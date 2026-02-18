@extends('layouts.admin')
@section('title','Thêm Nhóm')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm nhóm</h1>
    </div>
    @if($errors->any())
    <div class="alert alert-danger text-center">Vui lòng nhập đủ thông tin</div>
    @endif
    <form action="" method="post">

        <div class="mb-3">
            <label for="">Tên nhóm</label>
            <input type="text" name= "name"class= "form-control" placeholder="Tên" value="{{old('name')}}">
            @error('name')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới nhóm</button>
        @csrf
    </form>

@endsection
