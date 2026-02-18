
@extends('layouts.client')
@section('content')
<section class="py-2">

        <h1>Thêm sản phẩm</h1>
        <form action="" method="POST">
             @error('msg')
                 <div class="alert alert-danger text-center">{{$message}}</div>
             @enderror
           <div class="mb-3">
            <label for="">Tên sản phẩm</label>
             <input type="text" name="product_name" aria-label="" id="" value="{{old('product_name')}}">
             @error('product_name')
              <span class="text-danger">{{$message}}</span>

             @enderror
           </div>
             <div class="mb-3">
                <label for="">Giá sản phẩm</label>
                <input type="text" name="product_price" id="">
                 @error('product_price')
             <span class="text-danger">{{$message}}</span>


             @enderror
             </div>
            <button type="submit">submit</button>
            @csrf
            @method('POST')
        </form>

</section>

@endsection
