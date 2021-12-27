<script>
    localStorage.clickcount = 0;
    function runEnglish()
    {
        if (localStorage.clickcount) {
            localStorage.clickcount = Number(localStorage.clickcount)+1;
        }
        id_en = localStorage.clickcount;
        var htmlObj

        if (id_en == 1) {
            htmlObj = document.getElementById('option-description');

            htmlObj.innerHTML = htmlObj.innerHTML + '<div class="card-body" id="show-'+localStorage.clickcount+'"><div class="form-group">' +
                '<label for="inputName">'+ localStorage.clickcount +' - Tiêu đề </label> ' +
                '<input type="text" id="titleEn" name="lang['+ localStorage.clickcount +'][title]" class="form-control" value=""> ' +
                '</div>' +
                '<div class="form-group"> ' +
                '<label for="inputDescription">Mô tả ngắn</label> ' +
                '<textarea id="shortDescription"  name="lang['+ localStorage.clickcount +'][short_description]" class="form-control" rows="4"></textarea> ' +
                '</div> <div class="form-group"> <label for="inputDescription">Mô tả </label> ' +
                '<textarea id="description" name="lang['+ localStorage.clickcount +'][description]" class="form-control" rows="4"></textarea> </div>' +
                '<input type="button" class="btn btn-danger float-right" value="-" onclick="removeOption('+ localStorage.clickcount +')">' +
                '<div class="form-group float-left"> ' +
                '<div class="form-check"> ' +
                '<input class="form-check-input" name="lang['+ localStorage.clickcount +'][type_description]" value="en" type="radio">' +
                '<label class="form-check-label">(mô tả) English</label>' +
                '</div> ' +
                '<div class="form-check"> ' +
                '<input class="form-check-input" name="lang['+ localStorage.clickcount +'][type_description]" value="vn" checked type="radio">' +
                '<label class="form-check-label">(mô tả) Vietnamese</label>' +
                '</div> ' +
                '</div>' ;
            for (var i = Number(localStorage.clickcount)+1; i < 20-Number(id_en);i++){
                htmlObj.innerHTML = htmlObj.innerHTML +'<div class="card-body" style="display: none" id="show-'+(Number(i))+'"></div>' };

        } else {
            htmlObj = document.getElementById('show-' + id_en);
            $('#show-' + id_en).show();
            htmlObj.innerHTML = htmlObj.innerHTML + '<div class="form-group">' +
                '<label for="inputName">'+ localStorage.clickcount +' - Tiêu đề </label> ' +
                '<input type="text" id="titleEn" name="lang['+ localStorage.clickcount +'][title]" class="form-control" value=""> ' +
                '</div>' +
                '<div class="form-group"> ' +
                '<label for="inputDescription">Mô tả ngắn</label> ' +
                '<textarea id="shortDescription"  name="lang['+ localStorage.clickcount +'][short_description]" class="form-control" rows="4"></textarea> ' +
                '</div> ' +
                '<div class="form-group"> <label for="inputDescription">Mô tả </label> ' +
                '<textarea id="description" name="lang['+ localStorage.clickcount +'][description]" class="form-control" rows="4"></textarea> ' +
                '</div>' +
                '<input type="button" class="btn btn-danger float-right" onclick="removeOption('+ localStorage.clickcount +')" value="-">' +
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
        }

    }

    function removeOption(id){
        var parent = document.getElementById("option-description");
        var child = document.getElementById("show-"+id);
        parent.removeChild(child);
    }

    $(document).ready(function () {
        $('#add-description').on('click', function () {
            swalRedirectconfirmOption()
        })
    });

    function swalRedirectconfirmOption() {
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
                        runEnglish()
                        break;
                }
            });
    }
</script>
