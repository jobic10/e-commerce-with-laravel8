@extends('main')
@section('content')
    <div class="col-sm-9">
        <div class="font-weight-bold mb-3">

            Category (E.g. Laptop)
        </div>

        <div class='row'>
            <div class="callout" id="callout" style="display:none">
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                <span class="message"></span>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <img src="https://via.placeholder.com/150" width="100%" class="zoom"
                        data-magnify-src="images/large-dell-inspiron-15-7000-15-6.jpg">
                    <br><br>
                    <form class="form-inline" id="productForm">
                        <div class="form-group">
                            <div class="input-group col-sm-5">
                                <div class="input-group-prepend">

                                    <button type="button" id="minus" class="btn btn-outline-primary btn-sm minus"
                                        data-id="5"><i class="fa fa-minus fa-xs"></i></button>
                                </div>
                                <input type="text" class="form-control" placeholder=""
                                    aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button type="button" id="minus" class="btn btn-outline-primary btn-sm minus"
                                        data-id="5"><i class="fa fa-plus fa-xs"></i></button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-md btn-flat"><i
                                    class="fa fa-shopping-cart"></i> Add to Cart</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h1 class="page-header">DELL Inspiron 15 7000 15.6</h1>
                    <h3><b>&#36; 899.00</b></h3>
                    <p><b>Category:</b> <a href="category.php?category=laptops">Laptops</a></p>
                    <p><b>Description:</b></p>
                    <p>
                    <p>15-inch laptop ideal for gamers. Featuring the latest Intel&reg; processors for superior gaming
                        performance, and life-like NVIDIA&reg; GeForce&reg; graphics and an advanced thermal cooling design.
                    </p>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
