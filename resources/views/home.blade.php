<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Lapas Perempuan Klas IIA Malang</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

</head>
<body class="hold-transition layout-top-nav layout-footer-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
    </div>
    <div class="content">
      <!-- Box Content -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2 col-sm-4 col-4">
            <div class="info-box">
              <a href="#" class="info-box-icon bg-blue"><i class="fa fa-file-signature"></i>
              </a> 

              <div class="info-box-content">
                <span class="info-box-text">Ke RT/RW</span>
              <span class="info-box-number">{{$proses[1]??0}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-4 col-4">
            <div class="info-box">
              <a href="#" class="info-box-icon bg-indigo"><i class="fa fa-file-contract"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Dari RT/RW</span>
                <span class="info-box-number">{{$proses[2]??0}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-4 col-4">
            <div class="info-box">
              <a href="#" class="info-box-icon bg-purple"><i class="fa fa-clipboard"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Assesment</span>
                <span class="info-box-number">{{$proses[3]??0}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-4 col-4">
            <div class="info-box">
              <a href="#" class="info-box-icon bg-danger"><i class="fa fa-door-open"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Kronologi</span>
                <span class="info-box-number">{{$proses[4]??0}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-4 col-4">
            <div class="info-box">
              <a href="#" class="info-box-icon bg-teal"><i class="fa fa-user-shield"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Ke Litmas</span>
                <span class="info-box-number">{{$proses[5]??0}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-4 col-4">
            <div class="info-box">
                <a href="#" class="info-box-icon bg-cyan"><i class="fa fa-user-secret"></i>
                </a>

              <div class="info-box-content">
                <span class="info-box-text">Interview</span>
                <span class="info-box-number">{{$proses[6]??0}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
      </div>
      <div id="carouselExampleIndicators" class="carousel slide container-fluid" data-ride="carousel"  data-interval="10000">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
          @foreach ($binaans->chunk(9) as $key => $chunk)
            @if ($key == 0)
              <div class="carousel-item active">
            @else
              <div class="carousel-item">
            @endif
              <!-- <div class="container"> -->
                <!-- Data table -->
                <div class="card">
                  <div class="card-body">
                    <table class="table p-0 table-striped">
                      <thead>
                        <tr>
                          <th style="width: 10px">ID</th>
                          <th>Ke RT/RW</th>
                          <th>Dari RT/RW</th>
                          <th>Assesment</th>
                          <th>Kronologi</th>
                          <th>Ke Litmas</th>
                          <th>Interview</th>
                          <th>Dari Litmas</th>
                          <th style="width: 40px">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($chunk as $binaan)
                          <tr>
                            <td>{{$binaan->no_register}}</td>
                            @foreach ($binaan->proses as $key => $proses)
                                @if (isset($proses->pivot->tanggal))
                                  @php
                                    $tanggal_b = date_create($proses->pivot->tanggal);
                                    $interval = $tanggal_b->diff(date_create());
                                  @endphp
                                  @if($key < 4 || $key > 5 )
                                    <td>{{$proses->pivot->tanggal}}</td>
                                  @elseif($key==4)
                                    @if (isset($binaan->proses[5]->pivot->tanggal))
                                      <td>{{$proses->pivot->tanggal}}</td>
                                    @elseif($interval->d > 7 )
                                      <td><span class="badge bg-danger">{{$proses->pivot->tanggal}}</span></td>
                                    @else
                                      <td><span class="badge bg-warning">{{$proses->pivot->tanggal}}</span></td>
                                    @endif
                                  @elseif($key==5)
                                    @if ($binaan->petugasInterview->asal_petugas == 'luar malang')
                                      @if (isset($binaan->proses[6]->pivot->tanggal))
                                        <td>{{$proses->pivot->tanggal}}</td>
                                      @elseif($interval->d > 14 )
                                        <td><span class="badge bg-danger">{{$proses->pivot->tanggal}}</span></td>
                                      @else
                                        <td><span class="badge bg-warning">{{$proses->pivot->tanggal}}</span></td>
                                      @endif
                                    @else 
                                      @if($interval->d > 7 )
                                        <td><span class="badge bg-danger">{{$proses->pivot->tanggal}}</span></td>
                                      @else
                                        <td><span class="badge bg-warning">{{$proses->pivot->tanggal}}</span></td>
                                      @endif
                                    @endif
                                  @endif
                                @else
                                  <td>-</td>
                                @endif
                            @endforeach
                            @php
                              $persen = $binaan->proses()->wherePivot('tanggal', '!=', null)->count() / 7 * 100;
                            @endphp
                            @if ($persen < 55)
                              <td><span class="badge bg-danger">{{round($persen)}}%</span></td>
                            @elseif($persen > 85)
                              <td><span class="badge bg-success">{{round($persen)}}%</span></td>
                            @else
                              <td><span class="badge bg-warning">{{round($persen)}}%</span></td>          
                            @endif
                          </tr>                          
                        @endforeach
                        <!-- End Data -->
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- End Data Table -->
              <!-- </div> -->
            </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="width: 5%;">
          <i class="fa fa-chevron-left text-indigo" aria-hidden="true"></i>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="width: 5%;">
          <i class="fa fa-chevron-right text-indigo" aria-hidden="true"></i>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
      
  </div>
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Content</h5>
      <hr>
      <a href="#">Sidebar content</a>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        &copy; <a href="https://irit-io.id">irit.io</a> 2019. All rights reserved.
    </div>
    <!-- Default to the left -->
    <img src="{{ asset('img/logo-lp.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8"> Lembaga Pemasyarakatan Perempuan Klas IIA Malang. 
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

</body>
</html>
