@extends('customer.main')
@section('content')
    <div class="col-sm-9">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://picsum.photos/1559/510" class="d-block w-100" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1559x510" class="d-block w-100" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/1559/510" class="d-block w-100" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <h2>Monthly Top Products</h2>
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
