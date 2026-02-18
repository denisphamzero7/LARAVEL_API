<header class="shadow-sm py-3 bg-white sticky-top">
    <div class="container">
        <div class="row align-items-center"> {{-- Sửa align-center thành align-items-center --}}
            <div class="col-md-3 col-4">
                <a href="/" class="text-decoration-none text-dark">
                    <h2 class="m-0 fw-bold text-primary">
                        <i class="bi bi-box-seam"></i> Bầu cử
                    </h2>
                </a>
            </div>

            <div class="col-md-9 col-8 d-flex justify-content-end">
                {{-- Thêm flex-row để nằm ngang, gap-3 để tạo khoảng cách --}}
                <ul class="navbar-nav d-flex flex-row gap-4">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold text-primary" href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{route('product')}}">Sản phẩm</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Dịch vụ</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        {{-- Nút nổi bật --}}
                        <a class="btn btn-primary btn-sm px-3 rounded-pill" href="#">Đăng nhập</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
