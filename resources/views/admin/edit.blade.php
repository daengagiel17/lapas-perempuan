@extends('layouts.admin')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('admin.update', ['id' => $admin->id]) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama Admin</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{$admin->name}}">
                  </div>
                  <div class="form-group">
                    <label for="username">Username Admin</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="{{$admin->username}}">
                  </div>
                  <div class="form-group">
                    <label for="email">Email Admin</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{$admin->email}}">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{ route('admin.index') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection