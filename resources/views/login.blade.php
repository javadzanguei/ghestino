<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <title>سرویس قسطی</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/android-icon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="144x144" href="{{asset('images/android-icon-144x144.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicon-96x96.png')}}">
    <meta name="msapplication-TileColor" content="#fef200">
    <meta name="msapplication-TileImage" content="{{asset('images/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#111111" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#eeeeee" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    @livewireStyles
</head>
<body class="container-fluid p-0">
<div class="vw-100 vh-md-100 d-flex flex-column flex-md-row align-items-center">
    <div class="w-100 w-md-50 vh-50 vh-md-100 pt-5 pt-md-0 justify-content-center d-flex flex-md-column align-items-start align-items-md-center" style="background-color: var(--bs-yellow);" id="yellow-box">
        <h1 class="h1">سرویس قسطی</h1>
        <a href="https://ghestino-group.com" class="d-none d-md-block border border-2 rounded-4 border-primary my-1 px-3 py-1" aria-current="page">
            <svg fill="currentColor" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="16" height="16" viewBox="0 0 495.398 495.398" xml:space="preserve">
                <g>
                    <path d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391
                        v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158
                        c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747
                        c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"/>
                    <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401
                        c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79
                        c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"/>
                </g>
            </svg>
            صفحه اصلی
        </a>
    </div>
    <div class="w-100 w-md-50 h-60 h-md-60 rounded-5 pt-3" style="position: relative; background-color: #dfdfdf" id="login-box">
        <livewire:login/>
    </div>
    <a href="https://ghestino-group.com" class="d-md-none d-block border border-2 rounded-4 border-primary my-1 px-3 py-1" aria-current="page">
        <svg fill="currentColor" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             width="16" height="16" viewBox="0 0 495.398 495.398" xml:space="preserve">
                <g>
                    <path d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391
                        v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158
                        c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747
                        c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"/>
                    <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401
                        c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79
                        c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"/>
                </g>
            </svg>
        صفحه اصلی
    </a>
</div>
@include('layout.footer')
</body>
</html>
