<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập ngay</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
    @include('user.css')
</head>
<body class="preloading">
<div class="loader">
    <span class="fas fa-spinner xoay icon"></span>
</div>
@yield('content1')
<!-- partial -->
@include('user.js')
@if (session('status'))
    <script>
        swal("{{ session('status') }}", {
            button: false,
            timer: 2000
        });
    </script>
@endif
</body>
</html>
