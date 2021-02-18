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

                        <tr>
                            <td colspan="5" align="right"><b>Total</b></td>
                            <td><b>&#8358; </b></td>
                        </tr>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if (Auth::user())
                    <a href="{{ route('initPayment') }}" class="btn btn-primary">Make Payment</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login To Proceed</a>
                @endif

            </div>
        </div>
    </div>

@endsection

@section('custom_js')
    <script>
        var total = 0;
        $(function() {
            $(document).on('click', '.cart_delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route('deleteCart') }}',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        getDetails();
                        getCart();
                        getTotal();
                        swal(response.title, response.msg, response.type);
                    }
                });
            });

            $(document).on('click', '.minus', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var qty = $('#qty_' + id).val();
                if (qty > 1) {
                    qty--;
                } else {
                    swal('Denied', 'Minimum quantity reached', 'warning');
                    return;
                }
                $('#qty_' + id).val(qty);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('updateCart') }}',
                    data: {
                        id: id,
                        qty: qty,
                    },
                    dataType: 'json',
                    success: function(response) {

                        getDetails();
                        getCart();
                        getTotal();
                        // swal(response.title, response.msg, response.type);
                    }
                });
            });

            $(document).on('click', '.add', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var qty = $('#qty_' + id).val();
                qty++;
                $('#qty_' + id).val(qty);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('updateCart') }}',
                    data: {
                        id: id,
                        qty: qty,
                    },
                    dataType: 'json',
                    success: function(response) {

                        getDetails();
                        getCart();
                        getTotal();
                        // swal(response.title, response.msg, response.type);
                    }
                });
            });

            getDetails();
            getTotal();
        });

        function getDetails() {
            $('#tbody').html(
                "<tr><td colspan='6' class='text-center'><img class='img img-fluid' src='https://i.stack.imgur.com/FhHRx.gif'  height='150' width='150'></td></tr>"
            );
            $.ajax({
                type: 'GET',
                url: '{{ route('fetchCart') }}',
                dataType: 'json',
                success: function(response) {
                    $('#tbody').html(response);
                    getCart();
                }
            });
        }

        function getTotal() {
            $.ajax({
                type: 'GET',
                url: '{{ route('getCartTotal') }}',
                dataType: 'json',
                success: function(response) {
                    total = response;
                }
            });
        }

    </script>

@endsection
