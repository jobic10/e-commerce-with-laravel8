@extends('customer.main')
@section('content')
    <div class="col-sm-9">
        <div class="font-weight-bold mb-3">

            {{ $name }}
        </div>

        <div class='row'>
            @foreach ($products as $product)
                <div class='col-sm-4'>
                    <div class='card mb-3'>
                        <div class='box-body p-2'>
                            <img src='https://via.placeholder.com/100' width='100%' height='230px'
                                class='img-fluid img-thumbnail'>
                            <h5><a href='{{ route('getProduct', $product->id) }}'>{{ $product->name }}</a></h5>
                        </div>
                        <div class='card-footer'>
                            <b>&#836; {{ number_format($product->price, 2) }}</b>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>

@endsection
