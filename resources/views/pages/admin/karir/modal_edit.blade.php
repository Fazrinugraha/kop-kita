<div class="modal fade form-edit{{ $item->id_karir }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Karir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="scard-box">
                    <div class="row">
                        <div class="col-xl-12">
                            <form action="{{ route('update.karir', $item->id_karir) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group text-center">
                                    @if($item->foto)
                                        <img src="{{ asset($item->foto) }}" class="img-fluid" style="max-height: 200px;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Foto Karir (Kosongkan jika tidak ingin mengganti foto)</label>
                                    <input type="file" class="form-control" accept="image/png, image/jpeg" name="foto">
                                    <small class="text-muted">Ukuran file tidak lebih dari 5MB</small>
                                </div>
                                <div class="form-group">
                                    <label>Dokumen Syarat (Kosongkan jika tidak ingin mengganti dokumen)</label>
                                    <input type="file" class="form-control" accept=".pdf,.doc,.docx" name="dokumen_syarat">
                                    
                                    @if($item->dokumen_syarat)
                                        <a href="{{ asset($item->dokumen_syarat) }}" target="_blank" class="btn btn-link">Lihat Dokumen Saat Ini</a>
                                    @endif
                                    <small class="text-muted d-block">Isi Jika Ada. Tipe File pdf,.doc,.docx.
                                        <small class="text-muted d-block">Ukuran file tidak lebih dari 5MB</small>
                                  
                                </div>
                                <div class="form-group">
                                    <label>Judul Posisi</label>
                                    <input type="text" class="form-control" name="judul_posisi" placeholder="Judul Posisi" value="{{ $item->judul_posisi }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <input type="text" class="form-control" name="divisi" placeholder="Divisi" value="{{ $item->divisi }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Penempatan</label>
                                    <input type="text" class="form-control" name="penempatan" placeholder="Penempatan" value="{{ $item->penempatan }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" id="editor-edit-{{ $item->id_karir }}" name="deskripsi" placeholder="Deskripsi" required>{{ $item->deskripsi }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Kualifikasi</label>
                                    <textarea class="form-control" id="editor-kualifikasi-edit-{{ $item->id_karir }}" name="kualifikasi" placeholder="Kualifikasi" required>{{ $item->kualifikasi }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Benefit</label>
                                    <textarea class="form-control" id="editor-benefit-edit-{{ $item->id_karir }}" name="benefit" placeholder="Benefit">{{ $item->benefit }}</textarea>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        CKEDITOR.replace('editor-edit-{{ $item->id_karir }}', { versionCheck: false });
                                        CKEDITOR.replace('editor-kualifikasi-edit-{{ $item->id_karir }}', { versionCheck: false });
                                        CKEDITOR.replace('editor-benefit-edit-{{ $item->id_karir }}', { versionCheck: false });
                                    });
                                </script>
                                <div class="form-group">
                                    <label>Batas Lamar</label>
                                    <input type="date" class="form-control" name="batas_lamar" value="{{ $item->batas_lamar }}">
                                </div>
                                <div class="form-group">
                                    <label>Kuota</label>
                                    <input type="number" class="form-control" name="kuota" min="0" value="{{ $item->kuota }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="Aktif" {{ $item->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Non Aktif" {{ $item->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
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
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('textarea[id^="editor-edit-"]').forEach(function(textarea) {
            CKEDITOR.replace(textarea.id, {
                versionCheck: false,
            });
        });
    });
</script>
@endpush
