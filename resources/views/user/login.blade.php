@extends('user.layout')
@section('content1')
    <!-- partial:index.partial.html -->
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" name="register-user" id="register-user">
                <h1>Tạo Tài Khoản</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <div class="hide" id="email-exist"></div>
                </div>
                <span>hoặc sử dụng email để đăng ký</span>
                <input type="text" name="name" placeholder="Name" />
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <input type="password" name="confirm-password" placeholder="Confirm Password" />
                <button type="submit" id="submit-register">Đăng Ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form name="login-user" >
                <h1>Đăng Nhập</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                </div>
                <input type="hidden" id="login-true">
                <span>or use your account</span>
                <input type="email" name="email" placeholder="Email"/>
                <input type="password" name="password" placeholder="Password"/>
                <a href="{{route('guest.forgot-account')}}">Bạn quên mật khẩu ?</a>
                <button type="submit" id="submit-login">Đăng Nhập</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Để giữ kết nối với chúng tôi, vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                    <button class="ghost" id="signIn">Đăng Nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Nhập thông tin để nhận được những tiện ích của chúng tôi</p>
                    <button class="ghost" id="signUp">Đăng Ký</button>
                </div>
            </div>
        </div>
    </div>
@endsection
