@extends('layouts.admin')
@section('title','Danh sách người dùng')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách người dùng</h1>
    </div>
    @if(session('msg'))
    <div class="alert alert-message">
        {{ session('msg') }}
    </div>
    @endif
     {{-- dăng kí ở policy --}}
    @can('create',App\Models\User::class)
    <p><a href="{{route('admin.users.add')}}" class="btn btn-primary">Thêm mới</a></p>
    @endcan
    <table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%">STT</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            @can('users.edit')
             <th width="5%">Sửa</th>
            @endcan
            @can('users.delete')
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
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->group->name }}</td>
                    @can('users.edit')
                    <td><a href="{{route('admin.users.edit',$item->id)}}" class="btn btn-warning">Sửa</a></td>
                    @endcan
                    @can('users.delete')
                    <td>
                        @if(Auth::user()->id !== $item->id)
                            <form method="POST" action="{{ route('admin.users.delete', $item->id) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        @endif
                    </td>
                    @endcan
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
