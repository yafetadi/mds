<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Supplier</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Nama Supplier</label>
                        <input type="text" class="form-control" name="name" value="{{ $supplier->name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="address" value="{{ $supplier->address }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Telepon</label>
                        <input type="text" class="form-control" name="phone" value="{{ $supplier->phone }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>