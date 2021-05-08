<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                <li class="nav-item">
                    <a href="{{ URL::route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard<span class="badge badge-info right">2</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::route('getSurveys') }}" class="nav-link">
                    <i class="fas fa-poll nav-icon"></i>
                    <p>
                    Surveys
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right">6</span>
                    </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ URL::route('getSurveys') }}" class="nav-link">
                        <i class="fas fa-poll nav-icon"></i>
                        <p>Surveys</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ URL::route('newSurvey') }}" class="nav-link">
                        <i class="fa fa-plus nav-icon"></i>
                        <p>New survey</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/boxed.html" class="nav-link">
                        <i class="fas fa-trash nav-icon"></i>
                        <p>Deleted</p>
                        </a>
                    </li>              
                    </ul>
                </li>
                {{-- Configured sidebar links
                @ each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item') --}}

                
            </ul>
        </nav>
    </div>

</aside>
