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
        <div><a href="{{ route('users.add') }}" class="btn btn-primary">Thêm người dùng</a></div>
        <hr>
        <form action="" method="get" class="mb-3">
            <div class="row">


                <div class="col-3"><select class="form-control" name="status" id="">
                        <option value="0">Tất cả trạng thái</option>
                        <option value="active" {{request()->status=='active'?'selected':false}}>Kích hoạt</option>
                        <option value="inactive"{{request()->status=='inactive'?'selected':false}}>Chưa kích hoạt</option>
                    </select></div>
                <div class="col-3">
                    <select class="form-control" name="group_id" id="">
                        <option value="0">Tất cả nhóm</option>
                        @if (!empty(getAllGroups()))
                           @foreach (getAllGroups() as $item)
                               <option value="{{ $item->id }}"
                    {{ request()->group_id == $item->id ? 'selected' : false }}>
                    {{ $item->name }}
                </option>
                           @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-4">
                    <input type="search" value="{{request()->keywords}}" name="keywords" class="form-control"placeholder="Tìm kiếm">

                </div>
               <div class="col-2">
    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
</div>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="20%"><a href="?sort-by=fullname&sort-type={{$sortType}}">Tên</a></th>
                    <th width="20%"><a href="?sort-by=email&sort-type={{$sortType}}">Email</a></th>
                    <th  width="15%">Nhóm</th>
                    <th  width="15%">Trạng thái</th>
                    <th  width="15%"><a href="?sort-by=create_at&sort-type={{$sortType}}">Thời gian</a></th>
                    <th  width="20%">Hành động</th>
                </tr>
            </thead>
            <tbody>


                @if (!empty($userList))
                    @foreach ($userList as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td width="30%">{{ $item->fullname }}</td>
                            <td width="30%">{{ $item->email }}</td>
                            <td width="20%">
                               @if ($item->status==0)
                                  <button class="btn btn-danger">inactive</button>

                               @else
                                 <button class="btn btn-success">active</button>
                               @endif

                            </td>
                             <td width="20%">
                               @if ($item->group_name)
                                  <button class="btn btn-warning">{{$item->group_name}}</button>

                               @else
                                 <button class="btn btn-success">null</button>
                               @endif

                            </td>
                            <td width="10%">{{ $item->create_at }}</td>
                            <td width=20% class="d-flex gap-2">

                                <a href="{{ route('users.edit', ['id' => $item->id]) }}" class="btn btn-warning">Sửa</a>
                                <a onclick="return confirm('Bạn có muốn xoá')"
                                    href="{{ route('users.delete', ['id' => $item->id]) }}" class="btn btn-danger">Xoá</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">Không có người dùng</td>
                    </tr>
                @endif
            </tbody>
        </table>
    <div class="d-flex justify-content-end">
    {{ $userList->links() }}
</div>
    </div>
@endsection
