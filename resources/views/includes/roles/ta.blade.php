
<li class="sidebar-menu__item has-dropdown {{ Request::is('admin/user') || Request::is('admin/user/*') ? 'activePage' : '' }}">
    <a href="javascript:void(0)" class="sidebar-menu__link">
        <span class="icon"><i class="ph ph-graduation-cap"></i></span>
        <span class="text">Users</span>
    </a>
    <!-- Submenu start -->
    <ul class="sidebar-submenu">
    <li class="sidebar-submenu__item">
            <a href="{{ route('user.create') }}" class="sidebar-submenu__link"> Add User</a>
        </li>
        <li class="sidebar-submenu__item">
            <a href="{{ route('user') }}" class="sidebar-submenu__link"> View Users</a>
        </li>
       
        <li class="sidebar-submenu__item">
            <a href="{{ route('user.bulkupload') }}" class="sidebar-submenu__link"> Bulk Upload</a>
        </li>
      
    </ul>
    <!-- Submenu End -->
</li>

