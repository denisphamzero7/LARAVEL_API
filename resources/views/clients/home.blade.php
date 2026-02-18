@extends('layouts.client')

@section('title')
    <h1>{{ $title }}</h1>
@endsection


@section('sidebar')
    @parent
    <h3>Home sidebar</h3>
@endsection
@section('content')
@if (session('msg'))
<div class="alert alert-{{session('type')}}}">{{session('msg')}}</div>

@endif
    <section>

        Trang chủ
        @datetime('2021-12-15 15:00:30')
        @include('clients.contents.slide')
        <p><img src="https://i1-vnexpress.vnecdn.net/2016/11/15/la-et-has-donald-trump-broken-9491-3807-1479184524.jpg?w=680&h=0&q=100&dpr=1&fit=crop&s=i_CKckAsKgs9MBEmV7-tGg"
                alt=""></p>
        <p>
            {{-- <a href="{{ route('dowload-Image', ['image' => 'https://i1-vnexpress.vnecdn.net/2016/11/15/la-et-has-donald-trump-broken-9491-3807-1479184524.jpg?w=680&h=0&q=100&dpr=1&fit=crop&s=i_CKckAsKgs9MBEmV7-tGg']) }}" class="btn btn-primary">
        Download Image
    </a> --}}
            <a href="{{ route('dowload-Image', ['filename' => 'text.jpg']) }}">Download</a>
        </p>
    </section>
@endsection
