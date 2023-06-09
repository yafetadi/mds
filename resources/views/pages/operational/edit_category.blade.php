<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Kategori</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <br>
                                <span class="text-secondary">
                                    *Ketikkan keterangan dengan menggunakan titik dua ( : ) sebagai pemisah antar keterangan.
                                    Misalnya : Membeli pena: Membeli penghapus.
                                </span>
                                <br><br>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control">{{ $category->keterangan }}</textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->