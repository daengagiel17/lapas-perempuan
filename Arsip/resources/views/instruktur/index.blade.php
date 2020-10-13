@extends('layouts.admin')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Instruktur</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Instruktur</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Instruktur</h3>
                <div class="card-tools">
                  <a href="{{ route('instruktur.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Create</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($instrukturs as $key => $instruktur)
                    <tr>
                      <td>{{++$key}}</td>
                      <td><img src="{{ url($instruktur->photo)}}" alt="Photo Instruktur" style="width:100px;"></td>
                      <td>{{$instruktur->name}}</td>
                      <td>{{$instruktur->email}}</td>
                      <td>{{$instruktur->no_hp}}</td>
                      <td>
                        <a href="{{ route('instruktur.show', ['id' => $instruktur->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('instruktur.edit', ['id' => $instruktur->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{ route('instruktur.destroy', ['id' => $instruktur->id]) }}"
                            onclick="event.preventDefault();
                                          document.getElementById('destroy-form-{{$instruktur->id}}').submit();">
                            <i class="fas fa-trash"></i>
                        </a>
                        <form id="destroy-form-{{$instruktur->id}}" action="{{ route('instruktur.destroy', ['id' => $instruktur->id]) }}" method="POST" style="display: none;">
                            @csrf @method('DELETE')
                        </form>
                      </td>
                    </tr>                      
                  @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection