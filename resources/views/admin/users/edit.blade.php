@extends('layouts.admin')
@section('title','Cập nhật người dùng')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập nhật người dùng</h1>
    </div>
    @if($errors->any())
    <div class="alert alert-danger text-center">Vui lòng nhập đủ thông tin</div>
    @endif
    <form action="{{route('admin.users.edit', $user->id)}}" method="post">

        <div class="mb-3">
            <label for="">Tên người dùng</label>
            <input type="text" name= "name"class= "form-control" placeholder="Tên" value="{{old('name', $user->name)}}">
            @error('name')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">email</label>
            <input type="text"  name= "email" class="form-control" placeholder="email"  value="{{old('email', $user->email)}}">
             @error('email')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
         <div class="mb-3">
            <label for="">Mật khẩu</label>
            <input type="password"  name= "password" class="form-control" placeholder="Nhập mật khẩu nếu muốn thay đổi">
            @error('password')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Nhóm người dùng</label>
            <select name="group_id" id=""  class="form-control" >
                <option value="0" >Chọn nhóm</option>
                @if(@isset($groups))
                @foreach ($groups as $item)
                 <option value="{{$item->id}}" {{old('group_id', $user->group_id) == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                @endforeach
                @endif
            </select>
             @error('group_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
        @method('PUT')
        @csrf
    </form>

@endsection
