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
                <form action="{{route('admin.lang.store')}}" id="add-lang" method="POST">@csrf
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"></h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Từ Tiếng Việt</label>
                                    <input type="text" id="vn" name="vn" class="form-control" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Từ Tiếng Anh</label>
                                    <input type="text" id="en" name="en" class="form-control" value="" required>
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
                        <div class="card card-primary" id="option-description">
                            <div class="card-header">
                                <h3 class="card-title">Mô tả (limit 18)</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>


                        </div>
                        <div class="card card-primary">
                            <div class="card-footer">
                                <input type="button" value="+" id="add-description" onclick="swalRedirectconfirmOption()" class="btn btn-success float-right new-html">
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
