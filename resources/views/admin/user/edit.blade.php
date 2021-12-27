@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cập nhật tài khoản</h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form id="admin-edit-user">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
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
                                    <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                                    <label for="inputName">Họ và Tên</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">email</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{$user->email}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">password</label>
                                    <input type="password" id="password" name="password" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">confirm password</label>
                                    <input type="password" id="confirm-password" name="confirm_password"
                                           class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="status" name="status_user" class="form-control custom-select">
                                        <option @if($user->status == STATUS_ACTIVE) selected @endif value="{{STATUS_ACTIVE}}">Active</option>
                                        <option @if($user->status == STATUS_DISABLE) selected @endif value="{{STATUS_DISABLE}}">Disable</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Loại</label>
                                    <select id="inputStatus" name="type_user" class="form-control custom-select">
                                        <option @if($user->type == TYPE_USER_ADMIN) selected @endif value="{{TYPE_USER_ADMIN}}">ADMIN</option>
                                        <option @if($user->type == TYPE_USER_EDITOR) selected @endif value="{{TYPE_USER_EDITOR}}}">EDITOR</option>
                                        <option @if($user->type == TYPE_USER_NORMAL) selected @endif value="{{TYPE_USER_NORMAL}}">NORMAL</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <a href="{{route('admin.user.list')}}" class="btn" id="cancel">Cancel</a>
                        <input type="submit" value="update" id="update_user" class="btn btn-success float-right">
                    </div>
                    <div class="col-2"></div>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
