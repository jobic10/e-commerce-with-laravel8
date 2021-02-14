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
