<style>
    /* Small devices (tablets, 768px and up) */
    @media (min-width: 768px) {
        #navbar-search-input {
            width: 60px;
        }

        #navbar-search-input:focus {
            width: 100px;
        }
    }

    /* Medium devices (desktops, 992px and up) */
    @media (min-width: 992px) {
        #navbar-search-input {
            width: 150px;
        }

        #navbar-search-input:focus {
            width: 250px;
        }
    }

    .word-wrap {
        overflow-wrap: break-word;
    }

    .prod-body {
        height: 300px;
    }

    .box:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .register-box {
        margin-top: 20px;
    }

    #trending {
        list-style: none;
        padding: 10px 5px 10px 15px;
    }

    #trending li {
        padding-left: 1.3em;
    }

    #trending li:before {
        content: "\f046";
        font-family: FontAwesome;
        display: inline-block;
        margin-left: -1.3em;
        width: 1.3em;
    }

    /*Magnify*/
    .magnify>.magnify-lens {
        width: 100px;
        height: 100px;
    }

    .card {
        box-shadow: 0 0 10px 0 rgba(100, 100, 100, 0.26);
    }

    /* change the background color */
    .navbar-custom {
        background-color: #007BB6;
    }

    /* change the brand and text color */
    .navbar-custom .navbar-brand,
    .navbar-custom .navbar-text {
        color: rgba(255, 255, 255, .8);
    }

    /* change the link color */
    .navbar-custom .navbar-nav .nav-link {
        color: rgba(255, 255, 255, .5);
    }

    /* change the color of active or hovered links */
    .navbar-custom .nav-item.active .nav-link,
    .navbar-custom .nav-item:focus .nav-link,
    .navbar-custom .nav-item:hover .nav-link {
        color: #ffffff;
    }

</style>
