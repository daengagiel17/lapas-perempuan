<div class="card">
    <div class="card-header">
        <h3 class="card-title">Filter Data</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <select name="fakultas" id="fakultas" class="form-control text-capitalize" required>
                    <option value="">Select Fakultas</option>
                    @foreach ($fakultas as $fakulty)
                        <option value="{{$fakulty->id}}">{{$fakulty->slug}}</option>                    
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <select name="jurusan" id="jurusan" class="form-control text-capitalize" required>
                    <option value="">Select Jurusan</option>
                </select>
            </div>
            <div class="col-2">
                <select name="kelas" id="kelas" class="form-control" required>
                    <option value="">Select Kelas</option>
                </select>
            </div>
            <div class="col-3">
                <button type="button" id="filter" name="filter" class="btn btn-sm btn-primary">Filter</button>
                <button type="button" id="reset-filter" name="reset-filter" class="btn btn-sm btn-danger">Reset Filter</button>
            </div>
            <div class="col-3">
                <form action="{{ route($id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                               <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Import</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>   
        </div>
    </div>
</div>
