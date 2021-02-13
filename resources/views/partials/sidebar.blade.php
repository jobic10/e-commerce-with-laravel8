<div class="row">
    <div class="card w-100">
        <div class="card-header">
            <b>Most Viewed Today</b>
        </div>
        <div class="card-body">
            <ul id="trending">
                {{-- <?php
                $now = date('Y-m-d');
                $conn = $pdo->open();

                $stmt = $conn->prepare('SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10');
                $stmt->execute(['now' => $now]);
                foreach ($stmt as $row) {
                    echo "<li><a href='product.php?product=" . $row[' slug'] . "'>" . $row['name'] . '</a></li>';
                }
                $pdo->close();
                ?> --}}
                <li>A</li>
                <li>B</li>
                <ul>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="card primary w-100">
        <div class="card-header">
            <b>Subscribe</b>
        </div>
        <div class="card-body">
            <p>Get free updates on the latest products and discounts, straight to your inbox.</p>
            <form method="POST" action="">
                <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat"><i class="fa fa-envelope"></i> </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row mt-2" style="margin-bottom: 90px;">
    <div class='card w-100'>
        <div class='card-header'>
            <b>Follow us on Social Media</b>
        </div>
        <div class='card-body'>
            <a class="btn btn-social-icon  btn-facebook"><i class="fab fa-facebook text-primary"></i></a>
            <a class="btn btn-social-icon  btn-twitter"><i class="fab fa-twitter text-primary"></i></a>
            <a class="btn btn-social-icon  btn-instagram"><i class="fab fa-instagram text-danger"></i></a>
            <a class="btn btn-social-icon  btn-google"><i class="fab fa-google-plus text-danger"></i></a>
            <a class="btn btn-social-icon  btn-linkedin"><i class="fab fa-linkedin text-primary"></i></a>
        </div>
    </div>
</div>
