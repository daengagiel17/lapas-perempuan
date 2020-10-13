<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
            <div class="card-tools">
                <a href="{{ route('binaan.create') }}" class="btn btn-sm btn-success"><span class="fa fa-plus"></span> Binaan Baru</a>
            </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="{{$id}}" class="table table-striped table-bordered">
            <thead>
            <tr>
                {{$slot}}
            </tr>
            </thead>
        </table>
    </div>
    <!-- /.card-body -->
</div>