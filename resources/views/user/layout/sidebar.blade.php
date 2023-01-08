<aside class="sidebar sidebar-default navs-rounded ">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="{{ route('user.dashboard') }}" class="navbar-brand dis-none align-items-center justify-content-center">
            <svg width="36" class="text-primary" viewBox="0 0 128 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path
                        d="M117.348 105.33C117.594 105.476 117.669 105.799 117.508 106.036C110.26 116.759 99.5876 125.042 87.0232 129.687C74.2883 134.395 60.2849 135.117 47.0817 131.745C33.8785 128.372 22.1759 121.086 13.7027 110.961C5.22957 100.836 0.43531 88.4101 0.0282348 75.5189C-0.37884 62.6276 3.62286 49.9548 11.4421 39.3726C19.2614 28.7905 30.4835 20.8602 43.4505 16.7536C56.4176 12.6469 70.4417 12.5815 83.4512 16.5672C96.2865 20.4995 107.462 28.1693 115.375 38.4663C115.55 38.6939 115.495 39.0214 115.256 39.1813L97.3742 51.176C97.1539 51.3238 96.8567 51.2735 96.6942 51.0637C91.6372 44.53 84.5205 39.6627 76.3537 37.1606C68.031 34.6109 59.0591 34.6527 50.7636 37.2799C42.468 39.9071 35.2888 44.9804 30.2865 51.7502C25.2842 58.5201 22.7241 66.6274 22.9846 74.8745C23.245 83.1215 26.3121 91.0709 31.7327 97.5482C37.1533 104.025 44.64 108.687 53.0866 110.844C61.5332 113.002 70.4918 112.54 78.6389 109.528C86.6324 106.573 93.4288 101.316 98.0645 94.5111C98.2142 94.2913 98.5086 94.2233 98.7376 94.3583L117.348 105.33Z"
                        fill="#FF971D"></path>
                    <path
                        d="M53.2837 0.5C53.2837 0.223858 53.5075 0 53.7837 0H75.6195C75.8957 0 76.1195 0.223858 76.1195 0.5V26.25H53.2837V0.5Z"
                        fill="#FF971D"></path>
                    <path
                        d="M53.2837 123.75H76.1195V149.5C76.1195 149.776 75.8957 150 75.6195 150H53.7837C53.5075 150 53.2837 149.776 53.2837 149.5V123.75Z"
                        fill="#FF971D"></path>
                </g>
            </svg>
            <h4 class="logo-title m-0">OINEX</h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5">
                    </path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body p-0 data-scrollbar">
        <div class="collapse navbar-collapse pe-3" id="sidebar">
            <ul class="navbar-nav iq-main-menu">
                <li class="nav-item ">
                    <a class="nav-link @if(Route::is('user.dashboard')) active @endif" aria-current="page" href="{{ route('user.dashboard') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.15722 20.7714V17.7047C9.1572 16.9246 9.79312 16.2908 10.581 16.2856H13.4671C14.2587 16.2856 14.9005 16.9209 14.9005 17.7047V17.7047V20.7809C14.9003 21.4432 15.4343 21.9845 16.103 22H18.0271C19.9451 22 21.5 20.4607 21.5 18.5618V18.5618V9.83784C21.4898 9.09083 21.1355 8.38935 20.538 7.93303L13.9577 2.6853C12.8049 1.77157 11.1662 1.77157 10.0134 2.6853L3.46203 7.94256C2.86226 8.39702 2.50739 9.09967 2.5 9.84736V18.5618C2.5 20.4607 4.05488 22 5.97291 22H7.89696C8.58235 22 9.13797 21.4499 9.13797 20.7714V20.7714"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <hr class="hr-horizontal">
                </li>
                <li class="nav-item"> 
                    <span class="nav-link">Trading</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('user.market_rates')) active @endif" href="{{ route('user.market_rates') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Market Rates</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if(Route::is('user.fund_wallet')) active @endif" href="{{ route('user.fund_wallet') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Fund Wallet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('user.transfer_balance')) active @endif" href="{{ route('user.transfer_balance') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Transfer Balance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('user.trader.*')) active @endif" href="{{ route('user.trader.verify') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Verify Trader</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('user.withdraw')) active @endif" href="{{ route('user.withdraw') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Withdraw NGN Wallet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('user.sell_to_blackmarket')) active @endif" href="{{ route('user.sell_to_blackmarket') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Sell to Black Market</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../dashboard/maps/google.html">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Transaction History</span>
                    </a>
                </li>
                <li>
                    <hr class="hr-horizontal">
                </li>
                <li class="nav-item"> 
                    <span class="nav-link">Referral Earnings</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('user.referral')) active @endif" href="{{ route('user.referral') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Referrals</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('user.withdraw_referral')) active @endif" href="{{ route('user.withdraw_referral') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Withdraw Referral NGN Wallet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../dashboard/maps/google.html">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Exclusive Offers</span>
                    </a>
                </li>
                <li>
                    <hr class="hr-horizontal">
                </li>
                <li class="nav-item"> 
                    <span class="nav-link">Account Settings</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if (Route::is('user.profile.edit')) active @endif" href="{{ route('user.profile.edit') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Account Profile Settings</span>
                    </a>
                </li>
                @if (!auth()->user()->is_verified)
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('user.verify_account')) active @endif" href="{{ route('user.verify_account') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Account Verification KYC</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('user.change_pin')) active @endif" href="{{ route('user.change_pin') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Set Pin</span>
                    </a>
                </li>
                <li class="nav-item">
                    @if (!auth()->user()->bank)
                        <a class="nav-link @if (Route::is('user.create_bank_details')) active @endif" href="{{ route('user.create_bank_details') }}">
                    @else
                        <a class="nav-link @if (Route::is('user.edit_bank_details', auth()->user()->bank->id)) active @endif" href="{{ route('user.edit_bank_details', auth()->user()->bank->id) }}">                        
                    @endif
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Bank Account Wallet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../dashboard/maps/google.html">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Security & Password</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('user.logout') }}">
                        <i class="icon">
                            <svg width="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </i>
                        <span class="item-name">Logout</span>
                    </a>
                </li>
            </ul>
            <div style="height: 200px"></div>
        </div>
    </div>
</aside>
