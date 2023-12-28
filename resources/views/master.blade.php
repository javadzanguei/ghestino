<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <title>قسطی‌نو سرویس - صفحه کاربری</title>
    @include('layout.header')
    <style>
        .offline-alert, #unavailable-alert {
            position: fixed;
            top: 0;
            right: 0;
            z-index: 10000;
            background-color: rgba(187, 0, 0, 0.8);
            color: #ffffff;
            height: 20px;
            font-size: small;
            text-align: center;
            padding-right: 10px;
            padding-left: 10px;
        }
        .unavailable-alert {
            z-index: 10001;
        }
        a.nav-link.active {
            background-color: transparent!important;
            color: var(--bs-primary)!important;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-secondary-subtle overflow-x-hidden">
<livewire:offline/>
<div id="unavailable-alert" class="d-none">
    ارتباط شما با سرور برقرار نیست.
</div>
<div class="container-fluid p-0 pt-2 pt-md-0 m-0">
    <div class="vw-100 d-flex flex-column flex-md-row align-items-start bg-secondary-subtle">
        <div class="w-md-20 vh-md-100 overflow-hidden d-none d-md-block" style="background-color: var(--bs-yellow);" id="yellow-box">
            @auth('user')
                @include('layout.nav')
            @endauth
            @auth('customer')
                @include('layout.nav_customer')
            @endauth
        </div>
        <div class="w-100 w-md-80 vh-md-100 overflow-x-hidden overflow-y-auto px-md-2 px-md-4 py-md-2">
            @auth('user')
                @include('layout.offcanvas')
            @endauth
            @auth('customer')
                @include('layout.offcanvas_customer')
            @endauth
            <button class="d-md-none position-absolute btn border-0 p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar" style="top: 15px; right:15px; z-index: 1040;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
            @yield('content')
        </div>
    </div>
</div>
@include('layout.footer')
</body>
</html>
