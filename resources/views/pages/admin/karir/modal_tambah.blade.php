<div class="modal fade form-tambah" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Karir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="scard-box">
                    <div class="row">
                        <div class="col-xl-12">
                            <form action="{{ route('store.karir') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Foto Karir</label>
                                    <input type="file" class="form-control" accept="image/png, image/jpeg" name="foto">
                                    <small class="text-muted">Ukuran file tidak lebih dari 5MB</small>
                                </div>
                                <div class="form-group">
                                    <label>Dokumen Syarat</label>
                                    <input type="file" class="form-control" accept=".pdf,.doc,.docx" name="dokumen_syarat">
                                    <small class="text-muted">Isi Jika Ada</small>
                                    <small class="text-muted">Ukuran file tidak lebih dari 5MB</small>
                                </div>
                                <div class="form-group">
                                    <label>Judul Posisi</label>
                                    <input type="text" class="form-control" name="judul_posisi" placeholder="Judul Posisi" required>
                                </div>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <input type="text" class="form-control" name="divisi" placeholder="Divisi" required>
                                </div>
                                <div class="form-group">
                                    <label>Penempatan</label>
                                    <input type="text" class="form-control" name="penempatan" placeholder="Penempatan" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" id="editor-tambah" name="deskripsi" placeholder="Deskripsi" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Kualifikasi</label>
                                    <textarea class="form-control" id="editor-kualifikasi" name="kualifikasi" placeholder="Kualifikasi" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Benefit</label>
                                    <textarea class="form-control" id="editor-benefit" name="benefit" placeholder="Benefit"></textarea>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        CKEDITOR.replace('editor-tambah', { versionCheck: false });
                                        CKEDITOR.replace('editor-kualifikasi', { versionCheck: false });
                                        CKEDITOR.replace('editor-benefit', { versionCheck: false });
                                    });
                                </script>
                                <div class="form-group">
                                    <label>Batas Lamar</label>
                                    <input type="date" class="form-control" name="batas_lamar">
                                </div>
                                <div class="form-group">
                                    <label>Kuota</label>
                                    <input type="number" class="form-control" name="kuota" min="0" value="0" required>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non Aktif">Non Aktif</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@push('script')
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor-tambah', {
        versionCheck: false,
    });
</script>
@endpush
