<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script  src="{{asset('user/script.js')}}"></script>
<script>
    function swalmessage(message){
        swal(message, {
            buttons: false,
            timer: 2000
        });
    }

    $(document).ready(function () {
        $('#submit-register').on('click', function () {
            let name = document.forms["register-user"]["name"].value;

            if (name == "") {
                swalmessage("name không được rỗng")
                return false;
            }

            let email = document.forms["register-user"]["email"].value;

            if (email == "") {
                swal("email không được rỗng", {
                    buttons: false,
                    timer: 2000
                });
                return false;
            }

            if (!email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )){
                swal("email không đúng định dạng", {
                    buttons: false,
                    timer: 2000
                });
                return false;
            }

            let password = document.forms["register-user"]["password"].value;

            if (password == "") {
                swal("password không được rỗng", {
                    buttons: false,
                    timer: 2000
                });
                return false;
            }

            if(password.length < 6){
                swal("password không được dưới 6 kí tự", {
                    buttons: false,
                    timer: 2000
                });
                return false;
            }

            let confirm_password = document.forms["register-user"]["confirm-password"].value;

            if (confirm_password == "") {
                swal("Vui lòng nhập lại password", {
                    buttons: false,
                    timer: 2000
                });
                return false;
            }
            let password_1 = document.forms["register-user"]["password"].value;
            let confirm_password_1 = document.forms["register-user"]["confirm-password"].value;

            if (confirm_password_1 != password_1) {
                swal("password không trùng nhau", {
                    buttons: false,
                    timer: 2000
                });
                return false;
            }

            let name_1 = document.forms["register-user"]["name"].value;
            let email_1 = document.forms["register-user"]["email"].value;
            let password_2 = document.forms["register-user"]["password"].value;
            let _token = $('input[name="_token"]').val();

            let email_exist = document.forms["register-user"]["email"].value;

            $.ajax({
                url: "{{ route('home.check_exist_email') }}",
                method: "GET",
                data: {email_exist: email_exist},
                dataType: 'json',
                success: function (data) {
                    if (data == true) {
                        swal("email đã tồn tại ", {
                            buttons: false,
                            timer: 2000
                        });
                        return false;
                    } else {
                        $.ajax({
                            url: "{{ route('user.confirm-register') }}",
                            method: "GET",
                            data: {name: name_1, email: email_1, password: password_2, _token: _token},
                            dataType: 'json',
                            success: function (data) {
                                if (data == true) {
                                    swal("Đăng ký thành công! Đăng nhập ngay nào", {
                                        buttons: false,
                                        timer: 4000
                                    });
                                    document.getElementById("register-user").reset();
                                } else {
                                    swal("Lỗi không thể đăng ký", {
                                        buttons: false,
                                        timer: 2000
                                    });
                                }
                            }
                        })
                    }
                }
            })
            return false;
        });

        $('#submit-login').on('click', function () {
            let email = document.forms["login-user"]["email"].value;

            if (email == "") {
                swal("email không được rỗng", {
                    buttons: false,
                    timer: 2000
                });
                return false;
            }

            if (!email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )){
                swal("email không đúng định dạng", {
                    buttons: false,
                    timer: 2000
                });
                return false;
            }

            let password = document.forms["login-user"]["password"].value;

            if (password == "") {
                swal("password không được rỗng", {
                    buttons: false,
                    timer: 2000
                });
                return false;
            }

            let email_1 = document.forms["login-user"]["email"].value;
            let password_1 = document.forms["login-user"]["password"].value;
            $.ajax({
                url: "{{ route('user.confirm') }}",
                method: "GET",
                data: {email: email_1, password: password_1},
                dataType: 'json',
                success: function (data) {
                    if (data == true) {
                        swal("Tài khoản hoặc mật khẩu không chính xác", {
                            buttons: false,
                            timer: 2000
                        });
                    }else {
                        window.location.href = "/home";
                    }
                }
            })
            return false;
        });

    });
    $(window).on('load', function(event) {
        $('body').removeClass('preloading');
        // $('.load').delay(1000).fadeOut('fast');
        $('.loader').delay(1000).fadeOut('fast');
    });

</script>
