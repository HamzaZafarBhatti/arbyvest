<div class="navbar navbar-expand-md navbar-light navbar-static">
    <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
        <div class="navbar-brand navbar-brand-md">
            <a href="{{ route('admin.dashboard') }}" class="d-inline-block">
                <img src="{{ asset('asset/images/' . $set->logo) }}" style="height: 50px">
            </a>
        </div>

        <div class="navbar-brand navbar-brand-xs">
            <a href="{{ route('admin.dashboard') }}" class="d-inline-block">
                <img src="{{ asset('asset/images/' . $set->logo) }}" style="height: 50px">
            </a>
        </div>
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>
        <span class="navbar-text ml-md-3 mr-md-auto">
            <span class="badge badge-mark border-orange-300 mr-2"></span>
            Welcome back, {{ auth()->user()->name }}
        </span>

        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('asset/images/react.jpg')}}" class="rounded-circle" alt="">
                    <span>{{ auth()->user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.account') }}" class="dropdown-item"><i class="icon-lock"></i>
                            Account information</a>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item"><i class="icon-switch2"></i>
                        Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>
