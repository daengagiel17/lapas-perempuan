@extends('layouts.admin')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Warga Binaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Warga Binaan</li>
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
                <h3 class="card-title">Edit Warga Binaan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('binaan.update', ['id' => $binaan->id]) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="no_register">No Register</label>
                    <input type="text" class="form-control" id="no_register" name="no_register" placeholder="Enter No Register" value="{{$binaan->no_register}}">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Warga Binaan</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama" value="{{$binaan->nama}}">
                  </div>
                  <div class="form-group">
                    <label for="pidana">Pidana</label>
                    <input type="text" class="form-control" id="pidana" name="pidana" placeholder="Enter Pidana" value="{{$binaan->pidana}}">
                  </div>
                  <div class="form-group">
                    <label for="expirasi">Expirasi</label>
                    <input type="text" class="form-control" id="expirasi" name="expirasi" placeholder="Enter Expirasi" value="{{$binaan->expirasi}}">
                  </div>
                  <div class="form-group">
                    <label for="seperdua_mp">1/2 MP</label>
                    <input type="text" class="form-control" id="seperdua_mp" name="seperdua_mp" placeholder="Enter 1/2 MP" value="{{$binaan->seperdua_mp}}">
                  </div>
                  <div class="form-group">
                    <label for="duapertiga_mp">2/3 MP</label>
                    <input type="text" class="form-control" id="duapertiga_mp" name="duapertiga_mp" placeholder="Enter 2/3 MP" value="{{$binaan->duapertiga_mp}}">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{ route('binaan.index') }}" class="btn btn-danger">Cancel</a>
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