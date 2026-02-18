@extends('layouts.client')


{{-- @section('sidebar')
@parent
<h3>products sidebar</h3>

@endsection --}}
@section('content')
<section>

        Sản phẩm
         @push('scripts')
 <script>
    console.log('push 2');
 </script>
@endpush

</section>

@endsection

{{-- @section('js')
<script>
    console.log(ob);
</script>

@endsection --}}
 @push('scripts')
 <script>
    console.log('push 1');
 </script>
@endpush
