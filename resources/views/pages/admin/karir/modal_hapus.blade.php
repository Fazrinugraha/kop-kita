<div class="modal fade form-hapus{{ $item->id_karir }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel{{ $item->id_karir }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('delete.karir', $item->id_karir) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusLabel{{ $item->id_karir }}">Hapus Lowongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus lowongan posisi <strong>{{ $item->judul_posisi }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
