<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light mb-4 navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand text-white"><b>E</b> - Commerce</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse  " id="navbarSupportedContent">
                <ul class="nav nav-pill mr-auto">
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
                        <div class="dropdown-menu" style='background-color:white-smoke;'
                            aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Laptop</a>
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
                        ?>
                        <li class="nav-item">
                            <a href="#loginModal" role="button" class="nav-link text-white" data-toggle="modal">
                                LOGIN
                            </a>
                        </li>
                        <a href="#registerModal" role="button" class="nav-link text-white" data-toggle="modal">
                            REGISTER
                        </a>
                        <?php
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<?php
//login modal begin here
?>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Enter your username"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="message-text" placeholder="Enter your password"
                            required />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Login</button>
            </div>
        </div>
    </div>
</div>
<?php
//register modal
?>
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModal">Sign up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Enter fullname"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="message-text"
                            placeholder="Enter desired password" required />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="Enter Email" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Sign up</button>
            </div>
        </div>
    </div>
</div>
