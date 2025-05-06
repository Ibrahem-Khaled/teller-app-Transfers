<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">لوحة التحكم</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>لوحة التحكم</span></a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        الادارات
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>المستخدمين</span></a>
    </li>
   
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>الاقسام</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('courses.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>الدورات</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('videos.index') }}">
            <i class="fas fa-fw fa-video"></i>
            <span>المقاطع الفيديو</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('reviews.index') }}">
            <i class="fas fa-fw fa-star"></i>
            <span>التقييمات</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('comments.index') }}">
            <i class="fas fa-fw fa-comments"></i>
            <span>التعليقات</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user-courses.index') }}">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>تسجيلات الدورات</span></a>
    </li>
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
