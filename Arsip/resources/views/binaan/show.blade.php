@extends('layouts.admin')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
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
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-primary">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="{{ asset('img/profile/default.png') }}" alt="Warga Binaan">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{$binaan->nama}}</h3>
                <h5 class="widget-user-desc">{{$binaan->no_register}}</h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <label class="nav-link">Petugas Interview <span class="float-right badge bg-primary">{{$binaan->petugasInterview?Str::upper($binaan->petugasInterview->nama_petugas):'Belum ada data'}}</span></label>
                  </li>
                  <li class="nav-item">
                    <label class="nav-link">Asal Bapas Petugas <span class="float-right badge bg-primary">{{$binaan->petugasInterview?Str::upper($binaan->petugasInterview->asal_petugas):'Belum ada data'}}</span></label>
                  </li>
                  <li class="nav-item">
                    <label class="nav-link">Pidana <span class="float-right badge bg-warning">{{$binaan->pidana??'Belum ada data'}}</span></label>
                  </li>
                  <li class="nav-item">
                    <label class="nav-link">Expirasi <span class="float-right badge bg-success">{{$binaan->expirasi??'Belum ada data'}}</span></label>
                  </li>
                  <li class="nav-item">
                    <label class="nav-link">1/2 MP <span class="float-right badge bg-info">{{$binaan->seperdua_mp??'Belum ada data'}}</span></label>
                  </li>
                  <li class="nav-item">
                    <label class="nav-link">2/3 MP <span class="float-right badge bg-danger">{{$binaan->duapertiga_mp??'Belum ada data'}}</span></label>
                  </li>
                </ul>
              </div>
              <div class="card-footer">
                <div class="row">
                  @can('super admin')
                    <div class="col-md-4">
                      <a href="{{route('binaan.edit', ['id' => $binaan->id])}}" class="btn btn-sm btn-block btn-info"><i class="fa fa-edit"></i> Edit</a>
                    </div>
                    <div class="col-md-4">
                      <a class="btn btn-sm btn-danger btn-block" href="{{ route('binaan.destroy', ['id' => $binaan->id]) }}"
                          onclick="event.preventDefault();
                                        document.getElementById('destroy-form').submit();">
                          <i class="fas fa-trash"></i>
                          Hapus
                      </a>
                      <form id="destroy-form" action="{{ route('binaan.destroy', ['id' => $binaan->id]) }}" method="POST" style="display: none;">
                          @csrf @method('DELETE')
                      </form>
                    </div>                    
                    <div class="col-md-4">
                      <a href="{{route('binaan.index')}}" class="btn btn-sm btn-block btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>

                  @elsecan('admin')
                    <div class="col-md-6">
                      <a href="{{route('binaan.edit', ['id' => $binaan->id])}}" class="btn btn-sm btn-block btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    </div>
                    <div class="col-md-6">
                      <a href="{{route('binaan.show')}}" class="btn btn-sm btn-block btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                  @endcan
                </div>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Proses</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tr>
                    <th>Admin</th>
                    <th>Aktifitas</th>
                    <th>Waktu</th>
                  </tr>
                  @foreach ($prosess as $proses)
                    <tr>
                      <td>{{$proses->name_user}}</td>
                      <td>Input tanggal <strong>{{$proses->tanggal}}</strong> pada {{$proses->name_proses}}</td>
                      <td>{{isset($proses->updated_at)?\Carbon\Carbon::parse($proses->updated_at)->diffForHumans():'-'}}</td>
                    </tr>                      
                  @endforeach
                </table>
              </div>
              <!-- /.card-body -->
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