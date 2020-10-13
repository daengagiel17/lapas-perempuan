@extends('layouts.admin')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">    
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @component('components.wrapper', ['title' => "Surat"])
      <li class="breadcrumb-item active">Surat</li>
    @endcomponent

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          {{-- <div class="col-12">
            @component('components.filter', ["fakultas" => $fakultas, "id" => 'placement-test.store'])
            @endcomponent
          </div> --}}
          <div class="col-12">
            @component('components.table', ['id' => 'data-binaan'])
              @slot('title')
                List of Surat
              @endslot
              <th>#</th>
              <th>No Register</th>
              <th>Nama</th>
              <th>Ke RT/RW</th>
              <th>Dari RT/RW</th>
              <th>Assesment</th>
              <th>Kronologi</th>
              <th>
                <select name="ke_listmas" id="ke_litmas">
                  <option value="">Ke Litmas</option>
                  <option value="7">Lewat 7 hari</option>
                  <option value="14">Lewat 14 hari</option>
                </select>
              </th>
              <th>
                <select name="interview" id="interview">
                  <option value="">Interview</option>
                  <option value="7">Lewat 7 hari</option>
                  <option value="14">Lewat 14 hari</option>
                </select>
              </th>
              <th>Dari Litmas</th>
              <th>Action</th>
            @endcomponent
          </div>
        </div><!-- /.row -->
        @component('components.modal')
        @endcomponent
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
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    load_data();

    function load_data(waktu = '', category = '')
    {
      $("#data-binaan").DataTable({
        // "processing": true,
        "serverSide": true,
        "ajax": {
          url : "{{ route('binaan.index') }}",
          data : {
            waktu: waktu,
            category: category,
          }
        },
        "columns": [
          {
            data: 'DT_RowIndex',
            name: 'id'
          },
          {
            data: "no_register" ,
            name: "no_register"
          },
          {
            data: "nama",
            name: "nama"
          },
          {
            data: "surat_rt_dibuat",
            name: "surat_rt_dibuat"
          },
          {
            data: "surat_rt_kembali",
            name: "surat_rt_kembali"
          },
          {
            data: "assesment",
            name: "assesment"
          },
          {
            data: "kronologi",
            name: "kronologi"
          },
          {
            data: "permintaan_litmas",
            name: "permintaan_litmas"
          },
          {
            data: "interview_bapas",
            name: "interview_bapas"
          },
          {
            data: "litmas_datang",
            name: "litmas_datang"
          },
          {
            data: "action",
            name: "action"
          }
        ],
      });
    }

    $('body').on('click', '.update-proses', function () {
      if($(this).data('id-proses')==6)
      {
        $('#binaan_id_petugas').val($(this).data('id'));
        $('#proses_id_petugas').val($(this).data('id-proses'));
        $('#modal-input-petugas').modal('show');
      }
      else
      {
        $('#binaan_id').val($(this).data('id'));
        $('#proses_id').val($(this).data('id-proses'));
        $('#modal-input').modal('show');
      }
   });

    $('#save-button').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        // console.log($('#proses-form').serialize());
        $.ajax({  
          data: $('#proses-form').serialize(),
          url: "{{ route('binaan.update-proses') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log(data);
              $('#progres-form').trigger("reset");
              $('#modal-input').modal('hide');
              window.location = "{{route('binaan.index')}}";
          },
          error: function (data) {
              console.log('Error:', data);
              $('#save-button').html('Simpan');
          }
      });
    });  

    $('#save-button-petugas').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        console.log($('#proses-form-petugas').serialize());
        $.ajax({  
          data: $('#proses-form-petugas').serialize(),
          url: "{{ route('binaan.update-proses-petugas') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log(data);
              $('#progres-form-petugas').trigger("reset");
              $('#modal-input-petugas').modal('hide');
              window.location = "{{route('binaan.index')}}";
          },

          error: function (data) {
              console.log('Error:', data);
              $('#save-button-petugas').html('Simpan');
          }
      });
    });  

    $(document).on('change', '#ke_litmas', function(){
      var waktu = $(this).val();
      console.log(waktu);
      $('#data-binaan').DataTable().destroy();
      if(waktu != '')
      {
        load_data(waktu, 'ke_litmas');
      }
      else
      {
        load_data();
      }
    });

    $(document).on('change', '#interview', function(){
      var waktu = $(this).val();
      console.log(waktu);
      $('#data-binaan').DataTable().destroy();
      if(waktu != '')
      {
        load_data(waktu, 'interview');
      }
      else
      {
        load_data();
      }
    });

  });
</script>
@endsection