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
            <h1 class="text-start">{{ $title }}</h1>
        </div>

        {{-- Nhớ sửa lại route thành posts.delete-any (có chữ s) như bài trước đã fix --}}
        <form action="{{ route('posts.delete-any') }}" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa các mục đã chọn?')">
            @csrf

            {{-- SỬA NÚT TẠI ĐÂY --}}
            <button type="submit" class="btn btn-danger mb-2" id="deleteAllBtn" disabled>Xóa (0) mục</button>
            <hr>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">
                            <input type="checkbox" id="checkAll">
                        </th>
                        <th width="5%">STT</th>
                        <th width="10%">Tiêu đề</th>
                        <th width="30%">Nội dung</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($allPost->count() > 0)
                        @foreach ($allPost as $key => $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="delete[]" value="{{ $item->id }}" class="checkItem">
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->content }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>


        </form>
      <div class="d-flex justify-content-end">
{{ $allPost->links() }}
              </div>
    </div>

    {{-- SCRIPT MỚI --}}
    <script>
        const checkAll = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('.checkItem');
        const deleteAllBtn = document.getElementById('deleteAllBtn');

        function updateDeleteButton() {
            let count = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) count++;
            });

            deleteAllBtn.innerText = `Xóa (${count}) mục`;
            deleteAllBtn.disabled = count === 0;
        }

        checkAll.addEventListener('change', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = checkAll.checked;
            });
            updateDeleteButton();
        });

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateDeleteButton();
                if (!this.checked) checkAll.checked = false;
            });
        });
    </script>
@endsection
