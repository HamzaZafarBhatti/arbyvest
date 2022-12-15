<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    <h6 class="mb-0 text-white text-shadow-dark">{{ $set->site_name }}</h6>
                    <span class="font-size-sm text-white text-shadow-dark">{{ $set->title }}</span>
                </div>
            </div>
            <div class="sidebar-user-material-footer">
                <a href="#user-nav"
                    class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle"
                    data-toggle="collapse"><span>My account</span></a>
            </div>
        </div>
        <div class="collapse" id="user-nav">
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('admin.account') }}" class="nav-link">
                        <i class="icon-lock"></i>
                        <span>Account information</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="icon-switch2"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Route::is('admin.dashboard')) active @endif">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.banks.index') }}" class="nav-link @if(Route::is('admin.banks.*')) active @endif">
                        <i class="icon-home"></i>
                        <span>
                            Banks
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.market_prices.index') }}" class="nav-link @if(Route::is('admin.market_prices.*')) active @endif">
                        <i class="icon-home"></i>
                        <span>
                            Market Prices
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu @if(Route::is(['admin.roles.*','admin.users.*'])) nav-item-open @endif">
                    <a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>User
                            Manangement</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="User Manangement" @if(Route::is(['admin.roles.*','admin.users.*'])) style="display: block" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link @if(Route::is('admin.roles.index')) active @endif">
                                <i class="icon-user"></i>Roles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link @if(Route::is('admin.users.index')) active @endif">
                                <i class="icon-user"></i>User Accounts
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu @if(Route::is('admin.settings.*')) nav-item-open @endif">
                    <a href="#" class="nav-link"><i class="icon-cogs spinner"></i> <span>System
                            configuration</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="System configuration" @if(Route::is('admin.settings.*')) style="display: block" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.index') }}" class="nav-link @if(Route::is('admin.settings.index')) active @endif">
                                <i class="icon-hammer-wrench"></i>Settings
                            </a>
                        </li>
                        {{-- <li class="nav-item"><a href="{{ route('admin.email') }}" class="nav-link"><i
                                    class="icon-envelope"></i>Email</a></li>
                        <li class="nav-item"><a href="{{ route('admin.sms') }}" class="nav-link"><i
                                    class="icon-bubble"></i>Sms</a></li>
                        <li class="nav-item"><a href="{{ route('admin.account') }}" class="nav-link"><i
                                    class="icon-user"></i>Account information</a> --}}
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-pulse2"></i>
                        <span>MLM Plans</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="PY scheme">
                        <li class="nav-item"><a href="{{ route('admin.mlm-plans.create') }}" class="nav-link"><i
                                    class="icon-quill4"></i>Create plan</a></li>
                        <li class="nav-item"><a href="{{ route('admin.mlm-plans.index') }}" class="nav-link"><i
                                    class="icon-puzzle4"></i>Plans</a></li>
                        <li class="nav-item"><a href="{{ route('admin.mlm-coupons.index') }}" class="nav-link"><i
                                    class="icon-add"></i>Generate Coupons</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-pulse2"></i>
                        <span>Investment</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="PY scheme">
                        <li class="nav-item"><a href="{{ route('admin.plans.create') }}" class="nav-link"><i
                                    class="icon-quill4"></i>Create plan</a></li>
                        <li class="nav-item"><a href="{{ route('admin.plans.index') }}" class="nav-link"><i
                                    class="icon-puzzle4"></i>Plans</a></li>
                        <li class="nav-item"><a href="{{ route('admin.coupons.index') }}" class="nav-link"><i
                                    class="icon-add"></i>Generate Coupons</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-share2"></i><span>Affiliate Balance
                            Withdraw
                            system</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Withdraw">
                        <li class="nav-item"><a href="{{ route('admin.affliate.withdraw_log') }}"
                                class="nav-link"><i class="icon-list-unordered"></i>Withdraw log</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.affliate.withdraw_unpaid') }}"
                                class="nav-link"><i class="icon-spinner2 spinner"></i>Unpaid
                                withdrawal</a></li>
                        <li class="nav-item"><a href="{{ route('admin.affliate.withdraw_approved') }}"
                                class="nav-link"><i class="icon-thumbs-up2"></i>Approved withdrawal</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.affliate.withdraw_declined') }}"
                                class="nav-link"><i class="icon-accessibility"></i>Declined
                                withdrawal</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-share2"></i><span>MLM Balance Wallet
                            Withdraw
                            system</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Withdraw">
                        <li class="nav-item"><a href="{{ route('admin.mlm.withdraw_log') }}" class="nav-link"><i
                                    class="icon-list-unordered"></i>Withdraw log</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.mlm.withdraw_unpaid') }}" class="nav-link"><i
                                    class="icon-spinner2 spinner"></i>Unpaid
                                withdrawal</a></li>
                        <li class="nav-item"><a href="{{ route('admin.mlm.withdraw_approved') }}"
                                class="nav-link"><i class="icon-thumbs-up2"></i>Approved withdrawal</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.mlm.withdraw_declined') }}"
                                class="nav-link"><i class="icon-accessibility"></i>Declined
                                withdrawal</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-share2"></i><span>Referral Balance
                            Wallet
                            Withdraw
                            system</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Withdraw">
                        <li class="nav-item"><a href="{{ route('admin.ref.withdraw_log') }}" class="nav-link"><i
                                    class="icon-list-unordered"></i>Withdraw log</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.ref.withdraw_unpaid') }}" class="nav-link"><i
                                    class="icon-spinner2 spinner"></i>Unpaid
                                withdrawal</a></li>
                        <li class="nav-item"><a href="{{ route('admin.ref.withdraw_approved') }}"
                                class="nav-link"><i class="icon-thumbs-up2"></i>Approved withdrawal</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.ref.withdraw_declined') }}"
                                class="nav-link"><i class="icon-accessibility"></i>Declined
                                withdrawal</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-share2"></i><span>Paymentproof
                            system</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Paymentproof">
                        <li class="nav-item"><a href="{{ route('admin.paymentproof.log') }}" class="nav-link"><i
                                    class="icon-list-unordered"></i>Paymentproof log</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.paymentproof.pending') }}" class="nav-link"><i
                                    class="icon-spinner2 spinner"></i>Pending
                                paymentproof</a></li>
                        <li class="nav-item"><a href="{{ route('admin.paymentproof.approved') }}"
                                class="nav-link"><i class="icon-thumbs-up2"></i>Approved
                                paymentproof</a></li>
                        <li class="nav-item"><a href="{{ route('admin.paymentproof.declined') }}"
                                class="nav-link"><i class="icon-accessibility"></i>Declined
                                paymentproof</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-magazine"></i> <span>News
                            Section</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="News Section">
                        <li class="nav-item"><a href="{{ route('admin.blog.create') }}" class="nav-link"><i
                                    class="icon-quill4"></i>New Post</a></li>
                        <li class="nav-item"><a href="{{ route('admin.blog.index') }}" class="nav-link"><i
                                    class="icon-newspaper"></i>Articles</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-home4"></i> <span>Web
                            control</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="News Section">
                        <li class="nav-item"><a href="{{ route('admin.review') }}" class="nav-link"><i
                                    class="icon-clipboard6"></i>Platform Review</a></li>
                        <li class="nav-item"><a href="{{ route('admin.vendors.index') }}" class="nav-link"><i
                                    class="icon-accessibility"></i>Vendors</a></li>
                        <li class="nav-item"><a href="{{ route('admin.faq') }}" class="nav-link"><i
                                    class="icon-question4"></i>FAQs</a></li>
                        <li class="nav-item"><a href="{{ route('admin.terms') }}" class="nav-link"><i
                                    class="icon-file-check"></i>Terms & Condition</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.privacy_policy') }}" class="nav-link"><i
                                    class="icon-file-check"></i>Privacy policy</a></li>
                        <li class="nav-item"><a href="{{ route('admin.about_us') }}" class="nav-link"><i
                                    class="icon-file-check"></i>About us</a></li>
                        <li class="nav-item"><a href="{{ route('admin.social-links') }}" class="nav-link"><i
                                    class="icon-share2"></i>Social Links</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
