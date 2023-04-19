<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Katalog Stok</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('catalog.update', $catalog->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="branch_id" value="{{ $catalog->branch_id }}">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Cabang</label>
                        <input type="text" class="form-control"value="{{ $catalog->branch->name }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Produk</label>
                        <select class="form-control select2bs4" name="product_id">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $catalog->product_id == $product->id ? 'selected' : '' }}>{{ $product->code  }} - {{ $product->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>


<script>
    $(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>