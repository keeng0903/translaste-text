@extends('user.layout')
@section('content1')
    <!-- partial:index.partial.html -->
    <div class="container" id="container">
            <form name="input-email" >
                <h1>Nhập Email đã đăng ký</h1>
                <input type="email" name="email" placeholder="Email"/>
                <button type="submit" id="submit-login">Gửi email</button>
            </form>
    </div>
@endsection
