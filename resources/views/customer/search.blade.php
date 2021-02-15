@extends('customer.main')
@section('content')
    <div class="col-sm-9">
        <div class="font-weight-bold mb-3">
            Search : {{ $name }}
        </div>

        <div class='row'>
            @if (count($products))
                @foreach ($products as $product)
                    {{-- $highlighted = preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', $row['name']) --}}

                    <div class='col-sm-4'>
                        <div class='card mb-3'>
                            <div class='box-body p-2'>
                                <img src='https://via.placeholder.com/100' width='100%' height='230px'
                                    class='img-fluid img-thumbnail'>
                                <h5><a href='{{ route('getProduct', $product->id) }}'>{!! preg_filter('/' .
                                        preg_quote($name, '/') . '/i', '<b>$0</b>', $product->name) !!}</a>
                                </h5>
                            </div>
                            <div class='card-footer'>
                                <b>&#8358; {{ number_format($product->price, 2) }}</b>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <span class="alert alert-info">Sorry, your search returned nothing!</span>
            @endif
        </div>
        {{ $products->links() }}
    </div>

@endsection


{{-- <?php
$conn = $pdo->open();

$stmt = $conn->prepare('SELECT COUNT(*) AS numrows FROM products WHERE name LIKE :keyword');
$stmt->execute(['keyword' => '%' . $_POST['keyword'] . '%']);
$row = $stmt->fetch();
if ($row['numrows'] < 1) {
    echo '<h1 class="page-header">No results found for <i>' . $_POST['keyword'] . '</i></h1>';
} else {
    echo '<h1 class="page-header">Search results for <i>' . $_POST['keyword'] . '</i></h1>';
    try {
        $inc = 3;
        $stmt = $conn->prepare('SELECT * FROM products WHERE name LIKE :keyword');
        $stmt->execute(['keyword' => '%' . $_POST['keyword'] . '%']);

        foreach ($stmt as $row) {
            $highlighted = preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', $row['name']);
            $image = !empty($row['photo']) ? 'images/' . $row['photo'] : 'images/noimage.jpg';
            $inc = $inc == 3 ? 1 : $inc + 1;
            if ($inc == 1) {
                echo "<div class='row'>";
            }
            echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='" .
                $image .
                "' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=" .
                $row['slug'] .
                "'>" .
                $highlighted .
                "</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; " .
                number_format($row['price'], 2) .
                "</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
            if ($inc == 3) {
                echo '</div>';
            }
        }
        if ($inc == 1) {
            echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>";
        }
        if ($inc == 2) {
            echo "<div class='col-sm-4'></div></div>";
        }
    } catch (PDOException $e) {
        echo 'There is some problem in connection: ' . $e->getMessage();
    }
}

$pdo->close();
?> --}}
