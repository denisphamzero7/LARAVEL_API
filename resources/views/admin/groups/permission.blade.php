@extends('layouts.admin')
@section('title', 'Phân quyền nhóm - ' . $group->name)
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Phân quyền nhóm {{ $group->name }}</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Vui lòng nhập đủ thông tin</div>
    @endif
    @if (session('msg'))
        <div class="alert alert-message">
            {{ session('msg') }}
        </div>
    @endif
    <form action="" method="post">
        <table class="table table-borderd">
            <thead>
                <tr>
                    <th width="20%">Module</th>
                    <th>Quyền</th>
                </tr>
            </thead>
            <tbody>
                @if ($modules->count() > 0)
                    @foreach ($modules as $module)
                        <tr>
                            <td>{{ $module->name }}</td>
                            <td>
                                <div class="row">
                                    @if (!empty($roleListArray))
                                        @foreach ($roleListArray as $roleName => $roleLabel)
                                            <div class="col-2">
                                                <label for="role_{{ $module->name }}_{{ $roleName }}">
                                                    <input type="checkbox" name="role[{{ $module->name }}][]"
                                                        id="role_{{ $module->name }}_{{ $roleName }}"
                                                        value="{{ $roleName }}"
                                                        {{ isRole($roleArr, $module->name, $roleName) ? 'checked' : '' }}>
                                                    {{ $roleLabel }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($module->name == 'groups')
                                        <div class="col-2">
                                            <label for="role_{{ $module->name }}_permission">
                                                <input type="checkbox" name="role[{{ $module->name }}][]"
                                                    id="role_{{ $module->name }}_permission"  {{ isRole($roleArr, $module->name, 'permission') ? 'checked' : '' }} value="permission">
                                                Phân quyền
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Phân quyền</button>
        @csrf
    </form>

@endsection
