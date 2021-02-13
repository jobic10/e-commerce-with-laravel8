@extends('main')
@section('content')
    <div class="col-sm-9">
        <?php if (isset($_SESSION['error'])) {
        echo "
        <div class='alert alert-danger'>
            " .
            $_SESSION['error'] .
            "
        </div>
        ";
        unset($_SESSION['error']);
        } ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/banner1.png') }}" class="d-block w-100" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner2.png') }}" class="d-block w-100" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner3.png') }}" class="d-block w-100" alt="Third slide">
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
        <h2>Monthly Top Sellers</h2>

    </div>


@endsection
