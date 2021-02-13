<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light mb-4 navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse  float-left" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">About</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle  text-white" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Laptop</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something</a>
                        </div>
                    </li>

                    <form method="POST" class="navbar-form navbar-left" id='searchForm' action="">
                        <div class="input-group">
                            <input type="text" class="form-control" id='navbar-search-input'
                                placeholder="Search for Product">
                            <div class="input-group-append" style="cursor: pointer"
                                onclick="$(this).closest('form').submit();">
                                <span class="input-group-text" id="searchBtn"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </form>
                </ul>
                <div class="navbar-custom-menu ">
                    <ul class="nav navbar-nav ">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  text-white" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-shopping-cart   text-white"></i> <span
                                    class="label label-success cart_count"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header ">You have <span class="cart_count"></span> item(s) in cart
                                </li>
                                <li class="nav-item">
                                    <ul class="menu" id="cart_menu">
                                    </ul>
                                </li>
                                <li class="footer"><a href="cart_view.php">Go to Cart</a></li>
                            </ul>
                        </li>


                        <?php if (isset($_SESSION['user'])) {
                        $image = !empty($user['photo']) ? 'images/' . $user['photo'] : 'images/profile.jpg';
                        echo '
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="' .
                                $image .
                                '" class="user-image" alt="User Image">
                                <span class="hidden-xs">' .
                                    $user['firstname'] .
                                    ' ' .
                                    $user['lastname'] .
                                    '</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="' .
                                $image .
                                '" class="img-circle" alt="User Image">

                                    <p>
                                        ' .
                                        $user['firstname'] .
                                        ' ' .
                                        $user['lastname'] .
                                        '
                                        <small>Member since ' .
                                            date('M. Y', strtotime($user['created_on'])) .
                                            '</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        ';
                        } else {
                        echo '
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">LOGIN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">SIGN-UP</a>
                        </li>
                        ';
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
