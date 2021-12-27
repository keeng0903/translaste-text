@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm mới từ vựng</h1>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{route('admin.lang.update', $language->language_id)}}" id="update-lang" method="POST">@csrf
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"></h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Từ Tiếng Việt</label>
                                    <input type="text" id="vn" name="vn" class="form-control" value="{{$language->vn}}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Từ Tiếng Anh</label>
                                    <input type="text" id="en" name="en" class="form-control" value="{{$language->en}}"
                                           required>
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card card-primary" id="option-description-update">
                            <div class="card-header">
                                <h3 class="card-title">Mô tả (limit 18)</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" id="count-update" value="{{count($language_descriptions)}}">
                            @foreach($language_descriptions as $key => $language_description)
                                @if(!$language_description) <?php $clickCount = null ?> @endif
                                <div class="card-body" id="show-update-{{$key}}">
                                    <div class="form-group">
                                        <label for="inputName">{{ $clickCount = $key }} - Tiêu đề</label>
                                        <input type="text" id="titleEn" name="lang[{{$key}}][title]" class="form-control"
                                               value="{{$language_description->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Mô tả ngắn</label>
                                        <textarea id="shortDescription" name="lang[{{$key}}][short_description]"
                                                  class="form-control" rows="4">{{$language_description->short_description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Mô tả</label>
                                        <textarea id="description" name="lang[{{$key}}][description]" class="form-control"
                                                  rows="4">{{$language_description->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" name="lang[{{$key}}][type_description]" value="en" @if($language_description->type_description == TYPE_ENGLISH)checked @endif type="radio">
                                            <label class="form-check-label">(mô tả) English</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="lang[{{$key}}][type_description]" value="vn" @if($language_description->type_description == TYPE_VIETNAMESE)checked @endif type="radio">
                                            <label class="form-check-label">(mô tả) Vietnamese</label>
                                        </div>
                                    </div>
                                    <input type="button" class="btn btn-danger float-right" value="-" onclick="removeOptionUpdate({{$key}})">
                                </div>
                            @endforeach
                        </div>

                        <div class="card card-primary">
                            <div class="card-footer">
                                <input type="button" value="+" id="update-description" onclick="swalRedirectconfirmOptionUpdate()"
                                       class="btn btn-success float-right new-html">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <a href="{{route('admin.lang.list')}}" id="cancel" class="btn btn-secondary">Cancel</a>
                        <input type="submit" id="save-lang" value="Save Changes" class="btn btn-success float-right">
                    </div>
                    <div class="col-1"></div>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
