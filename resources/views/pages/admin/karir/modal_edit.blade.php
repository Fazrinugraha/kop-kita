<div class="modal fade form-edit{{ $item->id_karir }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel{{ $item->id_karir }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('update.karir', $item->id_karir) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel{{ $item->id_karir }}">Edit Lowongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul_posisi_{{ $item->id_karir }}">Judul Posisi</label>
                        <input type="text" class="form-control" id="judul_posisi_{{ $item->id_karir }}" name="judul_posisi" value="{{ $item->judul_posisi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="divisi_{{ $item->id_karir }}">Divisi</label>
                        <input type="text" class="form-control" id="divisi_{{ $item->id_karir }}" name="divisi" value="{{ $item->divisi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="penempatan_{{ $item->id_karir }}">Penempatan</label>
                        <input type="text" class="form-control" id="penempatan_{{ $item->id_karir }}" name="penempatan" value="{{ $item->penempatan }}" required>
                    </div>
                    <div class="form-group">
                        <label for="batas_lamar_{{ $item->id_karir }}">Batas Lamar</label>
                        <input type="date" class="form-control" id="batas_lamar_{{ $item->id_karir }}" name="batas_lamar" value="{{ $item->batas_lamar }}" required>
                    </div>
                    <div class="form-group">
                        <label for="status_{{ $item->id_karir }}">Status</label>
                        <select class="form-control" id="status_{{ $item->id_karir }}" name="status" required>
                            <option value="Aktif" {{ $item->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non Aktif" {{ $item->status == 'Non Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_{{ $item->id_karir }}">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_{{ $item->id_karir }}" name="deskripsi" rows="3" required>{{ $item->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="kualifikasi_{{ $item->id_karir }}">Kualifikasi</label>
                        <textarea class="form-control" id="kualifikasi_{{ $item->id_karir }}" name="kualifikasi" rows="3" required>{{ $item->kualifikasi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="kuota_{{ $item->id_karir }}">Kuota</label>
                        <input type="number" class="form-control" id="kuota_{{ $item->id_karir }}" name="kuota" min="1" value="{{ $item->kuota }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>
