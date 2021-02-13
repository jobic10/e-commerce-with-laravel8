@extends('main')
@section('content')
    <div class="col-sm-9">
        <div class="font-weight-bold mb-3">

            Category (E.g. Laptop)
        </div>

        <div class='row'>
            <?php for ($i = 0; $i < 6; $i++) { ?> <div class='col-sm-4'>
                <div class='card mb-3'>
                    <div class='box-body p-2'>
                        <img src='https://via.placeholder.com/100' width='100%' height='230px'
                            class='img-fluid img-thumbnail'>
                        <h5><a href='product.php?product=dell-inspiron-15-7000-15-6'>DELL Inspiron 15 7000 15.6</a></h5>
                    </div>
                    <div class='card-footer'>
                        <b>&#36; 899.00</b>
                    </div>
                </div>
        </div>
        <?php } ?>

    </div>
    </div>

@endsection
