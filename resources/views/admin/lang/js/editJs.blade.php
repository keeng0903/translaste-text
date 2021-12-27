
<script>
    function runEnglishUdate()
    {
        let count = document.forms["update-lang"]["count-update"].value;

        if (!count) {
            localStorage.clickcount = 0;
        } else {
            localStorage.clickcount = count
        }

        if (localStorage.clickcount) {
            localStorage.clickcount = Number(localStorage.clickcount)+1;
        }else {
            localStorage.clickcount = 1;
        }
        id_en = localStorage.clickcount;
        var htmlObj

        if (id_en == 1) {
            htmlObj = document.getElementById('option-description-update');

            document.getElementById("count-update").value = (count+1);
            htmlObj.innerHTML = htmlObj.innerHTML + '<div class="card-body" id="show-update-'+localStorage.clickcount+'"><div class="form-group">' +
                '<label for="inputName">'+ localStorage.clickcount +' - Tiêu đề </label> ' +
                '<input type="text" id="titleEn" name="lang['+ localStorage.clickcount +'][title]" class="form-control" value=""> ' +
                '</div>' +
                '<div class="form-group"> ' +
                '<label for="inputDescription">Mô tả ngắn</label> ' +
                '<textarea id="shortDescription"  name="lang['+ localStorage.clickcount +'][short_description]" class="form-control" rows="4"></textarea> ' +
                '</div> <div class="form-group"> <label for="inputDescription">Mô tả </label> ' +
                '<textarea id="description" name="lang['+ localStorage.clickcount +'][description]" class="form-control" rows="4"></textarea> </div>' +
                '<input type="button" class="btn btn-danger float-right" onclick="removeOptionUpdate('+ localStorage.clickcount +')" value="-">' +
                '<div class="form-group float-left"> ' +
                '<div class="form-check"> ' +
                '<input class="form-check-input" name="lang['+ localStorage.clickcount +'][type_description]" value="en" type="radio">' +
                '<label class="form-check-label">(mô tả) English</label>' +
                '</div> ' +
                '<div class="form-check"> ' +
                '<input class="form-check-input" name="lang['+ localStorage.clickcount +'][type_description]" value="vn" checked type="radio">' +
                '<label class="form-check-label">(mô tả) Vietnamese</label>' +
                '</div> ' +
                '</div>';
                for (var i = Number(localStorage.clickcount)+1; i < 20-Number(id_en);i++){
                    htmlObj.innerHTML = htmlObj.innerHTML +'<div class="card-body" style="display: none" id="show-update-'+(Number(i))+'"></div>' };
        } else {
            htmlObj = document.getElementById('show-update-' + id_en);
            if (htmlObj){
                $('#show-update-' + id_en).show();

                document.getElementById("count-update").value = (id_en++);
                htmlObj.innerHTML = htmlObj.innerHTML + '<div class="form-group">' +
                    '<label for="inputName">'+ localStorage.clickcount +' - Tiêu đề </label> ' +
                    '<input type="text" id="titleEn" name="lang['+ localStorage.clickcount +'][title]" class="form-control" value=""> ' +
                    '</div>' +
                    '<div class="form-group"> ' +
                    '<label for="inputDescription">Mô tả ngắn</label> ' +
                    '<textarea id="shortDescription"  name="lang['+ localStorage.clickcount +'][short_description]" class="form-control" rows="4"></textarea> ' +
                    '</div> <div class="form-group"> <label for="inputDescription">Mô tả </label> ' +
                    '<textarea id="description" name="lang['+ localStorage.clickcount +'][description]" class="form-control" rows="4"></textarea> ' +
                    '</div>' +
                    '<input type="button" class="btn btn-danger float-right" onclick="removeOptionUpdate('+ localStorage.clickcount +')" value="-">' +
                    '<div class="form-group float-left"> ' +
                    '<div class="form-check"> ' +
                    '<input class="form-check-input" name="lang['+ localStorage.clickcount +'][type_description]" value="en" type="radio">' +
                    '<label class="form-check-label">(mô tả) English</label>' +
                    '</div> ' +
                    '<div class="form-check"> ' +
                    '<input class="form-check-input" name="lang['+ localStorage.clickcount +'][type_description]" value="vn" checked type="radio">' +
                    '<label class="form-check-label">(mô tả) Vietnamese</label>' +
                    '</div> ' +
                    '</div>';
            }else {
                swal("Đã đạt giới hạn!", {
                    button: false,
                });
            }
        }

    }

    $(document).ready(function () {
        $('#add-description').on('click', function () {
            swalRedirectconfirmOption()
        })
    });

    function removeOptionUpdate(id){
        let count = document.forms["update-lang"]["count-update"].value;
        if (count){
            document.getElementById("count-update").value = (count-1);
        }
        var parent = document.getElementById("option-description-update");
        var child = document.getElementById("show-update-"+id);
        parent.removeChild(child);
    }

    function swalRedirectconfirmOptionUpdate() {
        swal("Bạn muốn thêm mô tả ?", {
            buttons: {
                cancel: "Huỷ",
                option: {
                    text: "Thêm!",
                    value: "option",
                },
            },
        })
            .then((value) => {
                switch (value) {
                    case "option":
                        runEnglishUdate()
                        break;
                }
            });
    }

</script>
