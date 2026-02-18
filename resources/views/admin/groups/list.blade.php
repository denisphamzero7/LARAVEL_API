@extends('layouts.admin')
@section('title','Danh sách Nhóm')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách Nhóm</h1>
    </div>
    @if(session('msg'))
    <div class="alert alert-message">
        {{ session('msg') }}
    </div>
    @endif
    @can('groups.add')
    <p><a href="{{route('admin.groups.add')}}" class="btn btn-primary">Thêm mới</a></p>
    @endcan
    <table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%">STT</th>
            <th>Tên</th>
            <th>Người đăng</th>

            <th width="15%">Phân quyền</th>
              @can('groups.edit')
            <th width="5%">Sửa</th>
             @endcan
              @can('groups.delete')
            <th width="5%">Xóa</th>
              @endcan
        </tr>
    </thead>
    <tbody>
        {{-- Kiểm tra biến $list có tồn tại không trước khi vòng lặp --}}
        @if(isset($lists))
            @forelse($lists as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{!empty($item->postBy->name)?$item->postBy->name:false }}</td>
                    <td>

                            <a href="{{route('admin.groups.permission',$item->id)}}" class="btn btn-primary">Phân quyền</a>

                    </td>
                    <td>
                        @can('groups.edit')
                            <a href="{{route('admin.groups.edit',$item->id)}}" class="btn btn-warning">Sửa</a>
                        @endcan
                    </td>
                    <td>
                        @can('groups.delete')
                            <form method="POST" action="{{ route('admin.groups.delete', $item->id) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa nhóm này không?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Không có dữ liệu</td>
                </tr>
            @endforelse
        @else
            <tr>
                <td colspan="5" class="text-center text-danger">Lỗi: Biến $list chưa được truyền từ Controller</td>
            </tr>
        @endif
    </tbody>
   </table>
@endsection
