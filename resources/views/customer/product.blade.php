@extends('customer.main')
@section('content')
    <div class="col-sm-9">
        <div class='row'>
            <div class="callout" id="callout" style="display:none">
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                <span class="message"></span>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <img src="https://via.placeholder.com/500" width="100%" height="100%"
                        class="img img-fluid zoom img-thumbnail " data-magnify-src="https://via.placeholder.com/1000">
                    <br><br>
                    <form class="form-inline" id="productForm">
                        <div class="form-group">
                            <div class="input-group col-sm-5">
                                <div class="input-group-prepend">

                                    <button type="button" id="minus" class="btn btn-outline-primary btn-sm minus"><i
                                            class="fa fa-minus fa-xs"></i></button>
                                </div>
                                <input type="number" readonly class="form-control" id='quantity' value='1'>
                                <div class="input-group-append">
                                    <button type="submit" id="add" class="btn btn-outline-primary btn-sm minus"><i
                                            class="fa fa-plus fa-xs"></i></button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-md btn-flat"><i
                                    class="fa fa-shopping-cart"></i> Add to Cart</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h1 class="page-header">{{ $product->name }}</h1>
                    <h3><b>&#8358; {{ number_format($product->price) }}</b></h3>
                    <p><b>Category:</b> <a
                            href="{{ route('category', $product->category->id) }}">{{ $product->category->name }}</a>
                    </p>
                    <p><b>Description:</b></p>
                    <p>
                    <p>{{ $product->description }}</p>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom_js')
    <script>
        $(function() {
            $('#add').click(function(e) {
                e.preventDefault();
                var quantity = $('#quantity').val();
                quantity++;
                $('#quantity').val(quantity);
            });
            $('#minus').click(function(e) {
                e.preventDefault();
                var quantity = $('#quantity').val();
                if (quantity > 1) {
                    quantity--;
                }
                $('#quantity').val(quantity);
            });

        });



        //Product Form
        var request;

        $(document).ready(function() {

            $('#productForm').submit(function(e) {
                e.preventDefault();
                if (request) {
                    request.abort();
                }
                // swal("Great", "No", 'success');

                // return;
                var product = {
                    product_id: {{ Request::segment(2) }},
                    quantity: $('#quantity').val()

                }
                console.log(product);
                request = $.ajax({
                    type: 'POST',
                    url: '{{ route('addToCart') }}',
                    data: product,
                    dataType: 'json',
                    success: function(response) {
                        swal(response.type.charAt(0).toUpperCase() + response.type.slice(1),
                            response.msg, response.type);
                        // swal("Great", "No", 'success');

                        getCart();
                    }
                });
            });
        });

    </script>

@endsection
