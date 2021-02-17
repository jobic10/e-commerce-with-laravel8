@extends('customer.main')
@section('content')
    <div class="col-sm-9">

        <div class="card">
            <div class="card-header font-weight-bold mb-3">
                Your Cart
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th width="20%">Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($carts as $cart)
                            <tr>
                                <td><button type="button" data-id="{{ $cart->id }}"
                                        class="btn btn-danger btn-sm cart_delete"><i
                                            class="fa fa-trash fa-xs "></i></button></td>
                                <td><img src="https://via.placeholder.com/30" width="20px" height="20px">
                                </td>
                                <td>{{ $cart->product->name }}</td>
                                <td>&#8358; {{ number_format($cart->product->price) }}</td>


                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">

                                            <button type="button" id="minus" class="btn btn-outline-primary btn-sm minus"
                                                data-id="{{ $cart->id }}"><i class="fa fa-minus fa-xs"></i></button>
                                        </div>
                                        <input type="text" value="{{ $cart->quantity }}" class="form-control"
                                            placeholder="" aria-label="Example text with button addon"
                                            aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button type="button" id="minus" class="btn btn-outline-primary btn-sm minus"
                                                data-id="{{ $cart->id }}"><i class="fa fa-plus fa-xs"></i></button>
                                        </div>
                                    </div>
                                </td>
                                <td>$ {{ number_format($cart->product->price * $cart->quantity) }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="5" align="right"><b>Total</b></td>
                            <td><b>$ 1,747.97</b></td>
                        </tr>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if (Auth::user())
                    <a href="#" class="btn btn-primary">Make Payment</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login To Proceed</a>
                @endif
            </div>
        </div>
    </div>

@endsection
