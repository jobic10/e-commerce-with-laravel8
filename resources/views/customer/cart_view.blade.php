@extends('main')
@section('content')
    <div class="col-sm-9">
        <div class="font-weight-bold mb-3">

            Your Cart
        </div>
        <div class="card">

            <div class="card table-responsive">
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
                            <td><button type="button" data-id="5" class="btn btn-danger btn-sm cart_delete"><i
                                        class="fa fa-trash fa-xs "></i></button></td>
                            <td><img src="https://via.placeholder.com/30" width="20px" height="20px">
                            </td>
                            <td>MICROSOFT Surface Pro 4 &amp; Typecover - 128 GB</td>
                            <td>$ 799.00</td>
                            <td class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" id="minus" class="btn btn-default btn-sm minus" data-id="5"><i
                                            class="fa fa-minus fa-xs"></i></button>
                                </span>
                                <input type="text" class="form-control" value="2" id="qty_5">
                                <span class="input-group-btn">
                                    <button type="button" id="add" class="btn btn-default btn-flat add" data-id="5"><i
                                            class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </td>
                            <td>$ 1,598.00</td>
                        </tr>

                        <tr>
                            <td colspan="5" align="right"><b>Total</b></td>
                            <td><b>$ 1,747.97</b></td>
                        </tr>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if (isset($_SESSION['user'])) {
        echo 'Checkout with paystack';
        } else {
        echo '
        <span>You need to <a href="#loginModal" data-toggle="modal">login</a> to proceed.</span>';
        } ?>
    </div>

@endsection
