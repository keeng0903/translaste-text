<script>
    function swalRedirectconfirmUpdate(){
        swal("Cập nhật thành thành công! Bạn muốn tới danh sách", {
            buttons: {
                cancel: "Huỷ",
                catch: {
                    text: "OK!",
                    value: "redirect",
                },

            },
        })
            .then((value) => {
                switch (value) {
                    case "redirect":
                        redirectListUser()
                        break;
                    default:
                        redirectReload();
                }
            });
    }
    // handle add user
    $(document).ready(function () {
        $('#update_user').on('click', function () {

            let name = document.forms["admin-edit-user"]["name"].value;

            if (name == "") {
                swalMessageNotButton("name không được rỗng")
                return false;
            }

            let password = document.forms["admin-edit-user"]["password"].value;

            if (password.length < 6 && password != "") {
                swalMessageNotButton("password không được dưới 6 kí tự")
                return false;
            }

            let confirm_password = document.forms["admin-edit-user"]["confirm-password"].value;

            if ((confirm_password == "" && password != "") || (confirm_password != "" && password == "") ) {
                swalMessageNotButton("Vui lòng nhập lại password")
                return false;
            }

            let password_1 = document.forms["admin-edit-user"]["password"].value;
            let confirm_password_1 = document.forms["admin-edit-user"]["confirm-password"].value;

            if (confirm_password_1 != password_1 && (confirm_password != "" || password != "") ) {
                swalMessageNotButton("password không trùng nhau")
                return false;
            }

            let id = document.forms["admin-edit-user"]["user_id"].value;
            let name_1 = document.forms["admin-edit-user"]["name"].value;
            let password_2 = document.forms["admin-edit-user"]["password"].value;
            let status_user = document.forms["admin-edit-user"]["status_user"].value;
            let type_user = document.forms["admin-edit-user"]["type_user"].value;
            let _token = $('input[name="_token"]').val();

            if (id != ""){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.user.update') }}",
                    data: {
                        id:id,
                        name : name_1,
                        password :password_2,
                        status: status_user,
                        type : type_user,
                        _token :_token
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data == true) {
                            swalRedirectconfirmUpdate()
                            document.getElementById("admin-edit-user").reset();
                        } else {
                            swalMessageNotButton("Lỗi không thể sửa tài khoản!")
                        }
                    }
                })
            }
            return false;
        });

    });

</script>
