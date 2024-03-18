<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">



            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->email }}
                    <i class="icon-md" data-feather="chevron-down"></i>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <ul class="list-unstyled p-1">

                        <li class="dropdown-item py-2">
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link text-body m-0 p-0">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
