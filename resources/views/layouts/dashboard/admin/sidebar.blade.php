<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('assets/img/sidebar-1.jpg') }}">   
    <div class="logo">
    <a href="#" class="simple-text logo-normal px-5">
        Test Run
    </a>
    </div>
    <div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item {{ (isset($menu) && $menu == 'dashboard' ) ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item {{ (isset($menu) && $menu == 'account' ) ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/account') }}">
                <i class="material-icons">person</i>
                <p>Account</p>
            </a>
        </li>
        <li class="nav-item {{ (isset($menu) && $menu == 'users' ) ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/users') }}">
                <i class="material-icons">supervisor_account</i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item {{ (isset($menu) && $menu == 'products' ) ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/products') }}">
                <i class="material-icons">storefront</i>
                <p>Products</p>
            </a>
        </li>
        <li class="nav-item {{ (isset($menu) && $menu == 'reservations' ) ? 'active':'' }}">
            <a class="nav-link" href="{{ url('admin/reservations') }}">
                <i class="material-icons">library_books</i>
                <p>Reservations</p>
            </a>
        </li>
        
        
        
        
    </ul>
    </div>
</div>