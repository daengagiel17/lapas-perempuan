<div class="modal fade" id="modal-input">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Progres Surat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="proses-form" name="proses-form" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="binaan_id" id="binaan_id">
                    <input type="hidden" name="proses_id" id="proses_id">
                    <label>Tanggal progres</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="date" class="form-control float-right" name="tanggal" id="tanggal" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="save-button">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-input-petugas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Progres Surat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="proses-form-petugas" name="proses-form-petugas" class="form-horizontal">
                    <div class="modal-body">
                        <input type="hidden" name="binaan_id_petugas" id="binaan_id_petugas">
                        <input type="hidden" name="proses_id_petugas" id="proses_id_petugas">
                        <label>Tanggal progres</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="date" class="form-control float-right" name="tanggal_petugas" id="tanggal_petugas" required>
                        </div>
                        <label for="nama_petugas">Nama Petugas</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" placeholder="Input nama petugas">
                        </div>
                        <label for="petugas">Asal Petugas</label>
                        <div class="input-group">
                            <select name="asal_petugas" id="asal_petugas" class="form-control">
                                <option value="">Pilih asal bapas petugas</option>
                                <option value="malang">Bapas Malang</option>
                                <option value="luar malang">Bapas Luar Malang</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="save-button-petugas">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    