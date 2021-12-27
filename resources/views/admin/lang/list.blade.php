@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TỪ VỰNG</h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a type="button" href="{{route('admin.lang.add')}}" class="btn btn-block btn-outline-primary">ADD NEW</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh Sách Từ Vựng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Tiếng Việt</th>
                                        <th>Tiếng Anh</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày cập nhật</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($languages)
                                        @foreach($languages as $language)
                                            <tr>
                                                <td>{{$language->language_id}}</td>
                                                <td>{{$language->vn}}</td>
                                                <td>{{$language->en}}</td>
                                                <td>{{$language->created_at}}</td>
                                                <td>{{$language->updated_at}}</td>
                                                <td class="project-actions text-right">
                                                    <a class="btn btn-info btn-sm" href="{{route('admin.lang.edit', $language->language_id)}}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" id="delete-lang" onclick="deleteRowLang({{$language->language_id}})" href="javascript:void(0)">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            </form>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
