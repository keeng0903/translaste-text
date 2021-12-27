<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Translate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Default Description">
    <meta name="keywords" content="fashion, store, E-commerce">
    <meta name="robots" content="*">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.css')
</head>
<body class="preloading hold-transition sidebar-mini layout-fixed">
<div id="wrapper">
    @include('admin.header')
    @include('admin.banner')



    @yield('content')

    @include('admin.aside')

</div>
<div class="loader">
    <span class="fas fa-spinner xoay icon"></span>
</div>
@include('admin.footer')

@include('admin.js')

</body>

</html>

