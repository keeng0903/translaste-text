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
    @include('engkids.frontend.css')
</head>
<body>
<div id="container preloading">
       <div class="row" style="margin-top: 5%">
        @include('engkids.frontend.header')
        @include('engkids.banner')
    </div>

    <div class="row">
        <div class="col-md-12">
            @yield('content1')

            @include('engkids.aside')
        </div>
    </div>
</div>
<div class="loader">
    <span class="fas fa-spinner xoay icon"></span>
</div>
@include('engkids.frontend.footer')

@include('engkids.frontend.js')
</body>

</html>

