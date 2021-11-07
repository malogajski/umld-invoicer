<header>
        <div class="wrapper">
            <nav class="navbar">
                <input type="checkbox" id="show-search">
                <input type="checkbox" id="show-menu">
                <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
                <div class="content">
                    <div class="logo"><a href="#">umld:inv</a></div>
                    <ul class="links">

                        <li><a href="{{ route('home') }}">Home</a></li>

                        <li>
                            <a href="#" class="desktop-link">Invoices</a>
                            <ul>
                                <li><a href="{{ route('home') }}">Show All</a></li>
                                <li><a href="{{ route('invoices.create') }}">Create new</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="desktop-link">Codebooks</a>
                            <ul>
                                <li>
                                    <a href="#" class="desktop-link">Products</a>
                                    <input type="checkbox" id="products">
                                    <label for="products">Products</label>
                                    <ul>
                                        <li><a href="{{ route('products.index') }}">Show All</a></li>
                                        <li><a href="{{ route('products.create') }}">Create new</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="desktop-link">Associates</a>
                                    <input type="checkbox" id="associates">
                                    <label for="associates">Associates</label>
                                    <ul>
                                        <li><a href="{{ route('associates.index') }}">Show All</a></li>
                                        <li><a href="{{ route('associates.create') }}">Create new</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="#" class="desktop-link">Admin</a>
                            <input type="checkbox" id="show-services">
                            <label for="show-services">Services</label>
                            <ul>
                                <li><a href="{{ route('create.host') }}">Host</a></li>
                                <li><a href="{{ route('show.users') }}">Users</a></li>
                                <li><a href="#">Drop Menu 3</a></li>
                                <li>
                                    <a href="#" class="desktop-link">More Items</a>
                                    <input type="checkbox" id="show-items">
                                    <label for="show-items">More Items</label>
                                    <ul>
                                        <li><a href="#">Sub Menu 1</a></li>
                                        <li><a href="#">Sub Menu 2</a></li>
                                        <li><a href="#">Sub Menu 3</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">Feedback</a></li>
                    </ul>
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
                <form action="#" class="search-box">
                    <input type="text" placeholder="Type Something to Search..." required>
                    <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
                </form>
            </nav>
        </div>
</header>



{{--<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block card-header sidebar collapse">--}}
{{--    <div class="position-sticky pt-3">--}}
{{--        <ul class="nav flex-column">--}}
{{--            <li class="nav-item">--}}

{{--                <a href="#" class="nav-fill">{{ trans('sidebar.invoices') }}</a>--}}
{{--                <ul>--}}
{{--                    <li><a class="nav-link active" aria-current="page" href="{{ route('home') }}">--}}
{{--                            <i class="fas fa-file-invoice mr-1"></i>--}}
{{--                            {{ trans('sidebar.all') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="nav-link" href="{{route('invoices.create')}}">--}}
{{--                            <i class="fas fa-file-invoice mr-1"></i>--}}
{{--                            {{ trans('sidebar.new') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{ route('associates.index') }}">--}}
{{--                    <span data-feather="file"><i class="fas fa-handshake"></i></span>--}}
{{--                    Customers--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{ route('products.index') }}">--}}
{{--                    <span data-feather="shopping-cart"><i class="fas fa-clipboard-list"></i></span>--}}
{{--                    Products--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">--}}
{{--                    <span data-feather="bar-chart-2"><i class="fas fa-coins"></i></span>--}}
{{--                    Reports--}}
{{--                </a>--}}
{{--            </li>--}}

{{--        </ul>--}}

{{--    </div>--}}
{{--</nav>--}}
