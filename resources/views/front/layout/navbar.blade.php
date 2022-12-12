<!-- Navbar Start -->
<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</small>
            <small class="ms-4"><i class="fa fa-clock text-primary me-2"></i>9.00 am - 9.00 pm</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small><i class="fa fa-envelope text-primary me-2"></i>info@example.com</small>
            <small class="ms-4"><i class="fa fa-phone-alt text-primary me-2"></i>+012 345 6789</small>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{route('front.index')}}" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="display-5 text-primary m-0">Finanza</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{route('front.index')}}" class="nav-item nav-link @if(Route::is('front.index')) active @endif">Home</a>
                <a href="{{route('front.market_rates')}}" class="nav-item nav-link @if(Route::is('front.market_rates')) active @endif">Market Rates</a>
                <a href="{{route('front.about')}}" class="nav-item nav-link @if(Route::is('front.about')) active @endif">About</a>
                <a href="{{route('front.services')}}" class="nav-item nav-link @if(Route::is('front.services')) active @endif">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle @if(Route::is(['front.projects','front.features','front.team','front.testimonial'])) active @endif" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu border-light m-0">
                        <a href="{{route('front.projects')}}" class="dropdown-item @if(Route::is('front.projects')) active @endif">Projects</a>
                        <a href="{{route('front.features')}}" class="dropdown-item @if(Route::is('front.features')) active @endif">Features</a>
                        <a href="{{route('front.team')}}" class="dropdown-item @if(Route::is('front.team')) active @endif">Team Member</a>
                        <a href="{{route('front.testimonial')}}" class="dropdown-item @if(Route::is('front.testimonial')) active @endif">Testimonial</a>
                    </div>
                </div>
                <a href="{{route('front.contact')}}" class="nav-item nav-link @if(Route::is('front.contact')) active @endif">Contact</a>
            </div>
            <div class="d-none d-lg-flex ms-2">
                <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="">
                    <small class="fab fa-facebook-f text-primary"></small>
                </a>
                <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="">
                    <small class="fab fa-twitter text-primary"></small>
                </a>
                <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="">
                    <small class="fab fa-linkedin-in text-primary"></small>
                </a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->
