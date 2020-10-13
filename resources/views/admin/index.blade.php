@extends('layouts.admin')

@section('css')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">    
@endsection


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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Admin</h3>
                <div class="card-tools">
                  <a href="{{ route('admin.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Create</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($admins as $key => $admin)
                    <tr id="admin-{{$admin->id}}">
                      <td>{{++$key}}</td>
                      <td><img src="{{ url($admin->photo)}}" alt="Photo Admin" style="width:100px;"></td>
                      <td>{{$admin->name}}</td>
                      <td>{{$admin->username}}</td>
                      <td>{{$admin->email}}</td>
                      <td>
                        <a href="{{ route('admin.show', ['id' => $admin->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.edit', ['id' => $admin->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-sm btn-danger delete-admin" data-id="{{$admin->id}}"><i class="fas fa-trash"></i></button>
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


@section('script')
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<!-- Ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.delete-admin').click(function() {
      var admin_id = $(this).data("id");
      confirm("Are you sure want to delete !");
    
      $.ajax({
          type: "DELETE",
          url: "{{ route('admin.store') }}"+'/'+admin_id,
          dataType: 'JSON',
          success: function (data) {
            if(data.status == "304"){
              toastr.error("You can't delete your self")
            }else{
              toastr.success('Success deleted')
              $('#admin-'+data.id).remove();
            }
            // table.draw();
          },
          error: function (data) {
            toastr.error("Deleted not success")
          }
      });      
    });
  });
</script>
@endsection