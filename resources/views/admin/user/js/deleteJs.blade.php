<script>
    function deleteRow(id){
        var token = $("meta[name='csrf-token']").attr("content");
        swal("Bạn muốn xoá tài khoản này!", {
            buttons: {
                cancel: "Huỷ",
                catch: {
                    text: "Xoá",
                    value: "redirect",
                }
            },
        })
            .then((value) => {
                switch (value) {
                    case "redirect":
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "/admin/user/delete/" + id,
                            type: 'DELETE',
                            data: {
                                token: token,
                            },
                            success: function (data_delete) {
                                if (data_delete) {
                                    deleteColumn("Xoá Thành công!")
                                } else {
                                    swalMessageNotButton("Lỗi không thể xoá!")
                                }
                            }
                        });
                        break;
                }
            });


    };

</script>
