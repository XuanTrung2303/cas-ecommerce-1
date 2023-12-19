<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    {{-- style="overflow-y: scroll;" --}}
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
                    <span class="menu-title">Category</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/dropdowns.html">
                                Sub Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/typography.html">
                                Child Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/typography.html">
                                Brand
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/icons/mdi.html">
                    <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                    <span class="menu-title">Icons</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/forms/basic_elements.html">
                    <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                    <span class="menu-title">Forms</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/charts/chartjs.html">
                    <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
                    <span class="menu-title">Charts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/tables/basic-table.html">
                    <span class="icon-bg"><i class="mdi mdi-table-large menu-icon"></i></span>
                    <span class="menu-title">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
                    <span class="menu-title">User Pages</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank
                                Page </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html">
                                Register </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404
                            </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500
                            </a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <!-- partial -->
    @yield('content_admin')
</div>
