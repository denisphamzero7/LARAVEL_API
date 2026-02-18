<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    @include('clients.blocks.header')
    <main class="py-5">
        <div class="row">
            <div class="col-3">
                <aside >
                    @section('sidebar')
                        @include('clients.blocks.sidebar')
                    @show
                </aside>
            </div>
            <div class="col-9">
                <div class="content">

                    @yield('content')
                </div>
            </div>
        </div>

        @include('clients.blocks.footer')
        <script src="{{ asset('assets/clients/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/clients/js/custom.js') }}"></script>
        @yield('js')
        @stack('scripts')
    </main>
</body>

</html>
