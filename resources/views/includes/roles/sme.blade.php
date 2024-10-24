@if ( auth('admin')->user()->role_id ==1 )
<li class="sidebar-menu__item {{ Request::is('admin') || Request::is('admin/dashboard') ? 'activePage' : '' }}">
    <a href="{{ route('dashboard') }}" class="sidebar-menu__link">
        <span class="icon"><i class="ph ph-squares-four"></i></span>
        <span class="text" style="font-family:'Segoe UI'">Reports </span>
    </a>
</li>
@endif


@if ( auth('admin')->user()->role_id ==1 )

<li class="sidebar-menu__item has-dropdown {{ Request::is('admin/lob') || Request::is('admin/lob/*') ? 'activePage' : '' }}">
    <a href="javascript:void(0)" class="sidebar-menu__link">
        <span class="icon"><i class="ph ph-graduation-cap"></i></span>
        <span class="text" style="text-transform: none;">Line of Business</span>
    </a>
    <!-- Submenu start -->
    <ul class="sidebar-submenu">
       <li class="sidebar-submenu__item">
            <a href="{{ route('lob.create') }}" class="sidebar-submenu__link">Add LoB</a>
        </li>
        <li class="sidebar-submenu__item">
            <a href="{{ route('lob') }}" class="sidebar-submenu__link"> View LoB</a>
        </li>
        
      
    </ul>
    <!-- Submenu End -->
</li>

<li class="sidebar-menu__item has-dropdown {{ Request::is('admin/sme') || Request::is('admin/sme/*') ? 'activePage' : '' }}">
    <a href="javascript:void(0)" class="sidebar-menu__link">
        <span class="icon"><i class="ph ph-graduation-cap"></i></span>
        <span class="text">SME</span>
    </a>
    <!-- Submenu start -->
    <ul class="sidebar-submenu">
    <li class="sidebar-submenu__item">
            <a href="{{ route('sme.create') }}" class="sidebar-submenu__link">Add SME</a>
        </li>
        <li class="sidebar-submenu__item">
            <a href="{{ route('sme') }}" class="sidebar-submenu__link">View SME</a>
        </li>
        
      
    </ul>
    <!-- Submenu End -->
</li>

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

<li class="sidebar-menu__item has-dropdown {{ Request::is('admin/course') || Request::is('admin/course/*') ? 'activePage' : '' }}">
    <a href="javascript:void(0)" class="sidebar-menu__link">
        <span class="icon"><i class="ph ph-graduation-cap"></i></span>
        <span class="text">Courses</span>
    </a>
    <!-- Submenu start -->
    <ul class="sidebar-submenu">
    <li class="sidebar-submenu__item">
            <a href="{{ route('course.create' )}}" class="sidebar-submenu__link"> Add Course </a>
        </li>
        <li class="sidebar-submenu__item">
            <a href="{{ route('course' )}}" class="sidebar-submenu__link"> View Courses </a>
        </li>
       
        
    </ul>
    <!-- Submenu End -->
</li>

<li class="sidebar-menu__item has-dropdown {{ Request::is('admin/course') || Request::is('admin/course/*') ? 'activePage' : '' }}">
    <a href="javascript:void(0)" class="sidebar-menu__link">
        <span class="icon"><i class="ph ph-graduation-cap"></i></span>
        <span class="text">TA</span>
    </a>
    <!-- Submenu start -->
    <ul class="sidebar-submenu">
    <li class="sidebar-submenu__item">
            <a href="{{ route('ta.create' )}}" class="sidebar-submenu__link"> Add TA </a>
        </li>
        <li class="sidebar-submenu__item">
            <a href="{{ route('ta' )}}" class="sidebar-submenu__link"> View TA </a>
        </li>
       
        
    </ul>
    <!-- Submenu End -->
</li>

<li class="sidebar-menu__item has-dropdown {{ Request::is('admin/admin') || Request::is('admin/admin/*') ? 'activePage' : '' }}">
    <a href="javascript:void(0)" class="sidebar-menu__link">
        <span class="icon"><i class="ph ph-graduation-cap"></i></span>
        <span class="text">Admin</span>
    </a>
    <!-- Submenu start -->
    <ul class="sidebar-submenu">
    <li class="sidebar-submenu__item">
            <a href="{{ route('admin.create') }}" class="sidebar-submenu__link"> Create Admin</a>
        </li>
        <li class="sidebar-submenu__item">
            <a href="{{ route('admin.list') }}" class="sidebar-submenu__link"> View Admin</a>
        </li>
        
      
    </ul>
    <!-- Submenu End -->
</li>
@endif 
<li class="sidebar-menu__item {{ Request::is('admin/assignment') || Request::is('admin/assignment/*') ? 'activePage' : '' }}">
    <a href="{{ route('assignment') }}" class="sidebar-menu__link">
        <span class="icon"><i class="ph ph-squares-four"></i></span>
        <span class="text" style="font-family:'Segoe UI'">Assignment</span>
    </a>
</li>
