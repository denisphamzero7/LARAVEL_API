@extends('layouts.admin')
@section('title','Chỉnh sửa bài viết')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa bài viết</h1>
    </div>
    @if($errors->any())
    <div class="alert alert-danger text-center">Vui lòng nhập đủ thông tin</div>
    @endif
    <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="">Tiêu đề</label>
            <input type="text" name= "title"class= "form-control" placeholder="Tên bài viết" value="{{old('title', $post->title)}}">
            @error('title')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        {{-- Phần Nội dung (Đã sửa) --}}
        <div class="mb-3">
            <label for="">Nội dung</label>
            {{--
                Lưu ý:
                1. Dùng thẻ <textarea> không phải <input>
                2. Đổi name="content" (để không trùng với title)
                3. Giá trị old() nằm GIỮA cặp thẻ đóng mở, không dùng thuộc tính value=""
            --}}
            <textarea name="content" class="form-control" placeholder="Nội dung bài viết" rows="5">{{ old('content', $post->content) }}</textarea>

            @error('content') {{-- Bắt lỗi theo name="content" --}}
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
        @csrf
    </form>

@endsection
