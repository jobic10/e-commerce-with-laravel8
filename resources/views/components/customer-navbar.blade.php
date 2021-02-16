<div>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light mb-4 navbar-custom">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand text-white"><b>Your</b> Company</a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse  " id="navbarSupportedContent">
                    <ul class="nav nav-pill mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="{{ route('homepage') }}">Home</a>
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
                                Category
                            </a>
                            <div class="dropdown-menu" style='background-color:white-smoke;'
                                aria-labelledby="navbarDropdown">
                                @foreach ($categories as $category)
                                    <a class="dropdown-item"
                                        href="{{ route('category', $category->id) }}">{{ $category->name }}</a>
                                @endforeach

                            </div>

                        </li>

                        <form class="navbar-form navbar-left" id='searchForm'
                            action="{{ route('searchForProduct') }}">
                            <div class="input-group">
                                <input type="text" name='search' class="form-control" id='navbar-search-input'
                                    placeholder="Search for Product">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-dark  btn-sm "><i
                                            class="fa fa-search fa-xs"></i></button>
                                </div>
                            </div>
                        </form>
                    </ul>
                    <div class="navbar-custom-menu ">
                        <ul class="nav navbar-nav ">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle  text-white" href="#" id="navbarDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-shopping-cart   text-white"></i> <sup><span
                                            class="badge badge-success count"></sup></span>
                                </a>
                                <ul id="cart_menu" class="dropdown-menu" style='background-color:white-smoke;'>
                                    <li class="header ">You have <span class="cart_count"></span> in cart
                                    </li>
                                    <a href="cart_view.php">Go to Cart</a>
                                </ul>
                            </li>


                            @if (Auth::user())
                                <li class="dropdown nav-link user user-menu">
                                    <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown">

                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
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
                            @else
                                <li class="nav-item">
                                    <a href="#loginModal" role="button" class="nav-link text-white" data-toggle="modal">
                                        Login
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="#registerModal" role="button" class="nav-link text-white"
                                            data-toggle="modal">
                                            Register
                                        </a>
                                    </li>
                                @endif
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>
</div>
