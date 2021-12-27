@extends('user.layout')
@section('content1')
    <!-- partial:index.partial.html -->
    <div class="container" id="container">
        <form name="login-user">
            <h1>Nhập password mới của bạn</h1>
            <input type="password" name="password" placeholder="Password"/>
            <input type="password" name="confirm-password" placeholder="Confirm Password"/>
            <button type="submit" id="submit-password">Thay đổi</button>
        </form>
    </div>
@endsection
