@extends('layouts.admin')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">    
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Terjadi Kesalahan!</h5>
              <ol>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ol>
          </div>
        @endif
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Data</h3>
              </div>
              <div class="card-body">
                <div class="row">
                <div class="col-2">
                  <select name="fakultas" id="fakultas" class="form-control" required>
                    <option value="">Select Fakultas</option>
                    @foreach ($fakultas as $fakulty)
                      <option value="{{$fakulty->id}}">{{Str::upper($fakulty->slug)}}</option>                    
                    @endforeach
                  </select>
                </div>
                <div class="col-2">
                  <select name="jurusan" id="jurusan" class="form-control" required>
                    <option value="">Select Jurusan</option>
                  </select>
                </div>
                <div class="col-2">
                  <select name="kelas" id="kelas" class="form-control" required>
                    <option value="">Select Kelas</option>
                  </select>
                </div>
                <div class="col-3">
                  <button type="button" id="filter" name="filter" class="btn btn-sm btn-info">Filter</button>
                </div>
                <div class="col-3">
                  <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-info" type="submit"><i class="fas fa-plus"></i> Import</button>
                          </div>
                        </div>
                      </div>
                  </form>
                </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Mahasiswa</h3>
                {{-- <div class="card-tools">
                  <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-success" type="submit"><i class="fas fa-plus"></i> Import Excel</button>
                          </div>
                        </div>
                      </div>
                  </form>
                </div> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="data-mahasiswa" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>NIM</th>
                      <th>Name</th>
                      <th>Fakultas / Jurusan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
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

@section('script')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- page script -->
<script type="text/javascript" language="javascript">
  $(function (){

    load_data();

    function load_data(fakultas = '', jurusan = '', kelas = '')
    {
      $("#data-mahasiswa").DataTable({
        // "processing": true,
        "serverSide": true,
        "ajax": {
          url : "{{ route('mahasiswa.index') }}",
          data : {
            fakultas: fakultas,
            jurusan: jurusan,
            kelas: kelas
          }
        },
        "columns": [
          {
            data: 'DT_RowIndex',
            name: 'id'
          },
          {
            data: "nim" ,
            name: "nim"
          },
          {
            data: "name",
            name: "name"
          },
          {
            data: "jurusan",
            name: "jurusan" 
          },
          {
            data: "action",
            name: "action" 
          }
        ],
      });
    }

    // Action Filter
    $('#filter').click(function() {
      var fakultas = $('#fakultas').val();
      var jurusan = $('#jurusan').val();
      var kelas = $('#kelas').val();

      $('#data-mahasiswa').DataTable().destroy();
      load_data(fakultas, jurusan, kelas);
    });
    
    // Reset Filter
    $('#reset-filter').click(function() {
      $('#fakultas').empty();
      $('#fakultas').append("<option value=''>Select Fakultas</option>");

      var fakultas = {!! json_encode($fakultas) !!};
      
      for (i = 0; i < fakultas.length; i++)
      {
          $('#fakultas').append("<option value='" + fakultas[i].id + "'>" + fakultas[i].name + "</option>");
      }

      $('#jurusan').empty();       
      $('#jurusan').append("<option value=''>Select Jurusan</option>");
      $('#kelas').empty();       
      $('#kelas').append("<option value=''>Select Kelas</option>");
    });

    // Select fakultas will set jurusan
    $('#fakultas').on('change', function() {

      var fakultas_id = $(this).val();

      // if select fakultas_id, empty jurusan and kelas then create option select jurusan
      if(fakultas_id)
      {
        $('#jurusan').empty();       
        $('#jurusan').append("<option value=''>Select Jurusan</option>");
        $('#kelas').empty();        
        $('#kelas').append("<option value=''>Select Kelas</option>");

        var jurusan = {!! json_encode($jurusans) !!};

        for (i = 0; i < jurusan[fakultas_id].length; i++)
        {
            // Set jurusan option
            $('#jurusan').append("<option value='" + jurusan[fakultas_id][i].id + "'>" + jurusan[fakultas_id][i].name + "</option>");
        }

      }
      else
      {
        $('#jurusan').empty();        
        $('#jurusan').append("<option value=''>Select Jurusan</option>");
        $('#kelas').empty();        
        $('#kelas').append("<option value=''>Select Kelas</option>");
      }      
    });    

    // Select jurusan will set kelas
    $('#jurusan').on('change', function() {

      var jurusans_id = $(this).val();

      // if select jurusan_id, empty kelas then create option select kelas
      if(jurusans_id)
      {

        $('#kelas').empty();       
        $('#kelas').append("<option value=''>Select Kelas</option>");

        var kelas = {!! json_encode($kelas) !!};

        for (i = 0; i < kelas[jurusans_id].length; i++)
        {
            // Set kelas option
            $('#kelas').append("<option value='" + kelas[jurusans_id][i].id + "'>" + kelas[jurusans_id][i].name + "</option>");
        }

      }
      else
      {
        $('#kelas').empty();        
        $('#kelas').append("<option value=''>Select Kelas</option>");
      }      
    });    

  });
</script>
@endsection