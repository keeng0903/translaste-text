@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TÀI KHOẢN</h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="" id="admin-list-user">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a type="button" href="{{route('admin.user.add')}}" class="btn btn-block btn-outline-primary">ADD NEW</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh Sách Người dùng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Tên</th>
                                        <th>email</th>
                                        <th>Loại</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($users)
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            {{$user->type}}
                                        </td>
                                        <td>
                                            {{$user->status}}
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm" href="{{route('admin.user.edit', $user->id)}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" id="delete-user" onclick="deleteRow({{$user->id}})" href="javascript:void(0)" >
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
            <!-- /.container-fluid -->
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
