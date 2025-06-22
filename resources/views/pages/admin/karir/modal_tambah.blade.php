<div class="modal fade form-tambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
<form action="{{ route('store.karir') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Lowongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul_posisi">Judul Posisi</label>
                        <input type="text" class="form-control" id="judul_posisi" name="judul_posisi" required>
                    </div>
                    <div class="form-group">
                        <label for="divisi">Divisi</label>
                        <input type="text" class="form-control" id="divisi" name="divisi" required>
                    </div>
                    <div class="form-group">
                        <label for="penempatan">Penempatan</label>
                        <input type="text" class="form-control" id="penempatan" name="penempatan" required>
                    </div>
                    <div class="form-group">
                        <label for="batas_lamar">Batas Lamar</label>
                        <input type="date" class="form-control" id="batas_lamar" name="batas_lamar" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kualifikasi">Kualifikasi</label>
                        <textarea class="form-control" id="kualifikasi" name="kualifikasi" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota</label>
                        <input type="number" class="form-control" id="kuota" name="kuota" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
