<script>
    function swalRedirectconfirmRegister(){
        swal("Tạo tài khoản thành công! Bạn muốn tới danh sách", {
            buttons: {
                cancel: "Huỷ",
                catch: {
                    text: "OK!",
                    value: "redirect",
                }
            },
        })
            .then((value) => {
                switch (value) {
                    case "redirect":
                        redirectListUser()
                        break;
                }
            });
    }
    // handle add user
    $(document).ready(function () {
        $('#save_user').on('click', function () {
            let name = document.forms["admin-add-user"]["name"].value;

            if (name == "") {
                swalMessageNotButton("name không được rỗng")
                return false;
            }

            let email = document.forms["admin-add-user"]["email"].value;

            if (email == "") {
                swalMessageNotButton("email không được rỗng")
                return false;
            }

            if (!email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )){
                swalMessageNotButton("email không đúng định dạng")
                return false;
            }

            let password = document.forms["admin-add-user"]["password"].value;

            if (password == "") {
                swalMessageNotButton("password không được rỗng")
                return false;
            }

            if(password.length < 6){
                swalMessageNotButton("password không được dưới 6 kí tự")
                return false;
            }

            let confirm_password = document.forms["admin-add-user"]["confirm-password"].value;

            if (confirm_password == "") {
                swalMessageNotButton("Vui lòng nhập lại password")
                return false;
            }
            let password_1 = document.forms["admin-add-user"]["password"].value;
            let confirm_password_1 = document.forms["admin-add-user"]["confirm-password"].value;

            if (confirm_password_1 != password_1) {
                swalMessageNotButton("password không trùng nhau")
                return false;
            }

            let name_1 = document.forms["admin-add-user"]["name"].value;
            let email_1 = document.forms["admin-add-user"]["email"].value;
            let password_2 = document.forms["admin-add-user"]["password"].value;
            let status_user = document.forms["admin-add-user"]["status_user"].value;
            let type_user = document.forms["admin-add-user"]["type_user"].value;

            let _token = $('input[name="_token"]').val();

            let email_exist = document.forms["admin-add-user"]["email"].value;

            $.ajax({
                url: "{{ route('home.check_exist_email') }}",
                method: "GET",
                data: {email_exist: email_exist},
                dataType: 'json',
                success: function (data) {
                    if (data == true) {
                        swalMessageNotButton("email đã tồn tại")
                        return false;
                    } else {
                        $.ajax({
                            url: "{{ route('admin.user.store') }}",
                            method: "GET",
                            data: {
                                name: name_1,
                                email: email_1,
                                password: password_2,
                                status: status_user,
                                type: type_user,
                                _token: _token
                            },
                            dataType: 'json',
                            success: function (data_insert) {
                                if (data_insert == true) {
                                    swalRedirectconfirmRegister()
                                    document.getElementById("admin-add-user").reset();
                                } else {
                                    swalMessageNotButton("Lỗi không thể đăng ký")
                                }
                            }
                        })
                    }
                }
            })
            return false;
        });

    });

</script>
