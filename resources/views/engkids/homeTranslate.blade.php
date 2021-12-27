@extends('engkids.layout')
@section('content1')
    <section id="contact">
        <div class="section-content">
            <h1 class="section-header"><span class="content-header wow fadeIn " data-wow-delay="0.2s"
                                             data-wow-duration="2s"> Translate</span> your text</h1>
            @if(!empty(Session()->get('user')))
                <h3>Hello <b><?php echo Session()->get('name_user') ?></b></h3>
            @else
                <h3>Write and click <b>TRANSLATE</b></h3>
            @endif
            <div class="row">
                <div class="col-md-3">
                    <h3 style="float: right"><i>Từ gợi ý hôm nay :</i></h3>
                </div>
                <div class="col-md-9">
                    <form action="" id="suggestion-form">
                        <marquee>
                            <h3>
                                    @foreach($randomEns as $randomEn)
                                        <i><a style="color: white" id="suggestions"
                                              onclick="suggestion_btn({{$randomEn->language_id}})">{{$randomEn->en}}</a></i> -
                                    @endforeach
                            </h3>
                        </marquee>
                    </form>
                </div>
            </div>
        </div>
        <div class="contact-section">
            <div class="container">
                <form>
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="from"> From</label>
                            <input type="hidden" id="user_id" value="<?php echo Session()->get('user_id') ?>">
                            <select name="from" id="input-language" autofocus>
                                @foreach($option_languages as $option_language)
                                    <option
                                        value="{{$option_language->type}}">{{ucfirst($option_language->name)}}</option>
                                @endforeach
                            </select></div>
                        <div class="form-group" id="font-text">

                            <textarea name="original" class="form-control" id="original"
                                      placeholder="Enter Your Text"></textarea>
                            <div id="result_search"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="from" id="output_lang" disabled>
                                <option value="en">Tiếng Anh</option>
                            </select>
                        </div>@csrf
                        <div class="form-group" id="font-text">
                        <textarea name="translated" class="form-control" id="translated" readonly
                                  placeholder="Translated text will be here"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-default submit" style="display: none"
                                    id="btn-hide-details"><i class="fa" aria-hidden="true"></i>Ẩn
                            </button>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-default submit" id="btn-details"><i class="fa"
                                                                                                     aria-hidden="true"></i>Chi
                                tiết
                            </button>
                        </div>
                        <br><br><br>
                    </div>
                </form>
            </div>
            <div class="container">
                <div class="col-md-12" id="show-details">
{{--                    //show details--}}
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {

            $('#input-language').change(function () {
                var type_language = $('#input-language').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('home.output_lang') }}",
                    method: "GET",
                    data: {type_language: type_language, _token: _token},
                    success: function (data) {
                        $('#output_lang').html(data);
                    }
                })
            })
            $('#input-language').focus()
            $('#output_lang').focus()

            $('#original').keyup(function () {
                var type = $('#input-language').val();
                var query = $(this).val();

                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('home.result_search') }}",
                        method: "GET",
                        data: {query: query, type: type, _token: _token},
                        success: function (data) {
                            $('#result_search').fadeIn();
                            $('#result_search').html(data);
                            var translated = query;
                            var type_output = $('#output_lang').val();
                            var type_input = $('#input-language').val();
                            $.ajax({
                                url: "{{ route('home.input_translated') }}",
                                method: "GET",
                                data: {translated: translated, type_output: type_output, type_input: type_input},
                                success: function (data_translated) {
                                    $('#translated').fadeIn();
                                    $('#translated').html(data_translated);
                                    $('#show-details').hide();
                                    $('#btn-details').show();
                                    $('#btn-hide-details').hide();
                                }
                            });
                        }
                    });
                } else {
                    $('#result_search').hide();
                    // document.querySelector('#translated').value = '';
                }
            });
            $('#output_lang').focus()
            $('#user_id').focus()

            $(document).on('click', 'li', 'a', function () {
                $('#original').val($(this).text());
                $('#result_search').fadeOut();
                var translated = $(this).text();
                var type_output = $('#output_lang').val();
                var type_input = $('#input-language').val();
                var user_id = $('#user_id').val();

                $.ajax({
                    url: "{{ route('home.translated') }}",
                    method: "GET",
                    data: {translated: translated, type_output: type_output, type_input: type_input},
                    success: function (data_translated) {
                        $('#translated').fadeIn();
                        $('#translated').html(data_translated);
                        if (user_id) {
                            $.ajax({
                                url: "{{ route('home.insert_history') }}",
                                method: "GET",
                                data: {type_input: type_input, translated: translated},
                                success: function (data_history) {
                                    $.ajax({
                                        url: "{{ route('home.histories') }}",
                                        method: "GET",
                                        data: {user_id: user_id},
                                        success: function (data_translated) {
                                            if ($("#show-language").is(":display") == true) {
                                                $('#show-language').fadeIn();
                                                $('#show-language').html(data_translated);
                                            }
                                        }
                                    });
                                }
                            });
                        }
                    }
                });
            });

            $('#translated').focus()

            $('#btn-details').on('click', function () {
                var lang_translated = $('#translated').val();
                var type_output = $('#output_lang').val();
                if (lang_translated) {
                    $('#btn-details').hide();
                    $('#btn-hide-details').show();
                    $.ajax({
                        url: "{{ route('home.lang_details') }}",
                        method: "GET",
                        data: {lang_translated: lang_translated, type_output: type_output},
                        success: function (data_translated) {
                            if (data_translated) {
                                $('#show-details').fadeIn();
                                $('#show-details').html(data_translated);
                            }
                        }
                    });
                } else {
                    swalMessageNotButton("Không tìm thấy từ!")
                }
            });
            $('#btn-hide-details').on('click', function () {
                $('#btn-details').show();
                $('#btn-hide-details').hide();
                $('#lang_details').hide();
            });

        });
        function suggestion_btn(id){
            if (id){
                var input_language = 'en';
                var output_language = 'vn';

                $.ajax({
                    url: "{{ route('home.suggestion_output') }}",
                    method: "GET",
                    data: {language_id: id},
                    success: function (data_sugestions) {
                        if (data_sugestions) {
                            $.ajax({
                                url: "{{ route('home.output_lang') }}",
                                method: "GET",
                                data: {type_language: input_language},
                                success: function (data) {

                                    $('#output_lang').html(data);
                                }
                            })
                            $('#translated').fadeIn();
                            $('#translated').html(data_sugestions);
                        }
                    }
                });
                $.ajax({
                    url: "{{ route('home.suggestion_input') }}",
                    method: "GET",
                    data: {language_id: id},
                    success: function (data_sugestions) {
                        if (data_sugestions) {
                            $.ajax({
                                url: "{{ route('home.input_lang') }}",
                                method: "GET",
                                data: {type_language: input_language},
                                success: function (data) {
                                    $('#input-language').html(data);
                                }
                            })
                            $('#original').fadeIn();
                            $('#original').html(data_sugestions);
                        }
                    }
                });
            }
        }
    </script>
@endsection

