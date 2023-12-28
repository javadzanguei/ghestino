<meta charset="utf-8">
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
<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('images/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicon-96x96.png')}}">
<meta name="msapplication-TileColor" content="#fef200">
<meta name="msapplication-TileImage" content="{{asset('images/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#111111" media="(prefers-color-scheme: light)">
<meta name="theme-color" content="#eeeeee" media="(prefers-color-scheme: dark)">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-custom.css')}}">
<link rel="stylesheet" href="{{asset('css/panel.css')}}">
@stack('styles')
@livewireStyles

