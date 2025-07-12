    <header class="bg-light">
        <!-- Navbar  Top-->
        @include('frontend.layouts.top-navbar')
        <!-- End Navbar Top  -->


        <!-- Navbar  -->
        <!-- Navbar menu  -->
        @include('frontend.layouts.navbar-menu')
        <!-- End Navbar menu  -->


        <!-- Navbar sidebar menu  -->
        <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-aside" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="widget__form-search-bar  ">
                            <div class="row no-gutters">
                                <div class="col">
                                    <input class="form-control border-secondary border-right-0 rounded-0" value=""
                                        placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <nav class="list-group list-group-flush">
                            <ul class="navbar-nav ">
                                <li class="nav-item">
                                    <a class="nav-link active text-dark" href="index.html"> Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="about-us.html"> About </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="blog.html">Blog </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active dropdown-toggle  text-dark" href="#"
                                        data-toggle="dropdown">Pages </a>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        <li><a class="dropdown-item" href="blog_details.html">Blog details</a></li>
                                        <li><a class="dropdown-item" href="404.html"> 404 Error</a></li>

                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link  text-dark" href="contact.html"> Contact </a>
                                </li>
                            </ul>

                        </nav>
                    </div>
                    <div class="modal-footer">
                        <p>© 2020 <a href="https://websolutionus.com/.com">WebSolutionUS</a>
                            -
                            Premium template news, blog & magazine &amp;
                            magazine theme by <a href="https://websolutionus.com/.com">websolutionus.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </header>