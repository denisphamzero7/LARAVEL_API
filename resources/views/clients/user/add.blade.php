@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <div>
        <div class="py-3">
            <h1 class="text-start">
                {{ $title }}
            </h1>
        </div>
      @if ($errors->any())
      <div class="alert alert-danger">Dữ liệu không hợp lệ</div>

      @endif
       <form action="" method="post">
            <div class="mb-3">
                <label for="">Họ và tên</label>
                <input type="text" class="form-control" value="{{old('fullname')}}" name="fullname" placeholder="Nhập họ và tên">
            @error('fullname')
          <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" class="form-control" value="{{old('email')}}" name="email" placeholder="Nhập email">
                 @error('email')
          <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="">Nhóm</label>
                <select name="group_id" id="form-control">
                    <option value="0">Chọn nhóm</option>
                        @if (!empty($allgroups))
                           @foreach ($allgroups as $item)
                               <option value="{{ $item->id }}"
                    {{ old('group_id') == $item->id ? 'selected' : false }}>
                    {{ $item->name }}
                </option>
                           @endforeach
                        @endif
                </select>
                 @error('group_id')
          <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
             <div class="mb-3">
                <label for="">Trạng thái</label>
                <select name="status" id="form-control">
                    <option value="0"   {{ old('status') == 0 ? 'selected' : false }}>Chưa kích hoạt</option>
                    <option value="1"  {{ old('status') == 1 ? 'selected' : false }}>kích hoạt</option>
                </select>
            </div>
           <button class="btn btn-primary">Thêm mới</button>
           <a href="{{route('users.index')}}" class="btn btn-warning">Quay lại</a>
        @csrf
       </form>

    </div>
@endsection
