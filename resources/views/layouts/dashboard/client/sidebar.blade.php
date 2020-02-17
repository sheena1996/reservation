<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('assets/img/sidebar-1.jpg') }}">   
    <div class="logo">
    <a href="#" class="simple-text logo-normal px-5">
        Test Run
    </a>
    </div>
    <div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item {{ (isset($menu) && $menu == 'dashboard' ) ? 'active':'' }}">
            <a class="nav-link" href="{{ url('clients/dashboard') }}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item {{ (isset($menu) && $menu == 'profile' ) ? 'active':'' }}">
            <a class="nav-link" href="{{ url('clients/profile') }}">
                <i class="material-icons">person</i>
                <p>Profile</p>
            </a>
        </li>
        
        <li class="nav-item {{ (isset($menu) && $menu == 'reservations' ) ? 'active':'' }}">
            <a class="nav-link" href="{{ url('clients/reservations') }}">
                <i class="material-icons">playlist_add_check</i>
                <p>Reservations</p>
            </a>
        </li>
        
        
    </ul>
    </div>
</div>