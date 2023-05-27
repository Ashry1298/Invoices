<!-- Title -->

<title> @yield('title')</title>
<!-- Favicon -->
<link rel="icon" href="{{ URL::asset('assets/img/brand/favicon.png') }}" type="image/x-icon" />
<!-- Icons css -->
<link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{ URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
<!--  Sidebar css -->
<link href="{{ URL::asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
<!-- Sidemenu css -->
@php
    $lang = app()->getLocale() == 'ar' ? '-rtl' : '';
    // $lang = app()->getLocale();
    // $lang == 'ar' ? '-rtl' : '';
@endphp

<link rel="stylesheet" href="{{ URL::asset('assets') }}/css{{ $lang }}/sidemenu.css">

<link rel="stylesheet" href="{{ URL::asset('assets') }} /css{{ $lang }}/sidemenu.css">
@yield('css')
<link href="{{ URL::asset('assets') }}/css{{ $lang }}/style.css" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{ URL::asset('assets') }}/css{{ $lang }}/style-dark.css" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{ URL::asset('assets') }}/css{{ $lang }}/skin-modes.css" rel="stylesheet">
