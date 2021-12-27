<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('asset/style/home.css')}}">
    <link rel="stylesheet" href="{{asset('asset/style/search.css')}}">
    <link rel="stylesheet" href="{{asset('asset/style/camera.css')}}">
    <script src="https://kit.fontawesome.com/7ec0e9a7d2.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
@if(isset($_SESSION['home']) && count(array($_SESSION['home'])) > 0)
    <div class="header" id="myHeader">
        <div class="img-header">
            <a href="{{ route('engkid.home')}}"><img src="{{asset('asset/image/logo.png')}}" alt=""></a>
        </div>

        <div class="search-header">
            <div class="input-group">
                <form action="{{route('engkid.search')}}" class="form-search" method="get">
                    <input type="text" class="input-search" placeholder="Search vocabulary" name="word" required value />
                    <button class="button-search"><i class="fas fa-search"></i></button>
                </form>
                <a href="{{ route('engkid.camera')}}"><button type="button" class="button-camera"><i class="fas fa-video"></i></button></a>
            </div>
        </div>

        <div class="user-header">
            <div class="btn-group">
                <button type="button" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('asset/image/logo-small.png')}}" alt="">
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item pt-3 pb-4" href="">History</a>
                    <a class="dropdown-item" href="">Another action</a>
                    <a class="dropdown-item" href="">Something else here</a>
                </div>
            </div>
        </div>
    </div>
@endif