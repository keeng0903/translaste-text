@extends('user.layout')
@section('content1')
    <!-- partial:index.partial.html -->
    <div class="container" id="container">
        <form action="#" name="otp-user" id="otp-user">
            <h1>Nhập mã otp</h1>
            <span>email</span>
            <input type="text" name="otp" placeholder="otp"/>
            <button type="submit" id="submit-register">Xác nhận</button>
        </form>
    </div>
@endsection
