<div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" action="{{ route('product.update', $product->id) }}">
        @csrf
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Produk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kategori Produk</label>
                            <select class="form-control select2bs4" name="category_id" id="category_id" style="width: 100%;">
                                @foreach($categories as $category)    
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->code }} - {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kode Produk</label>
                            <input type="text" name="code" class="form-control" value="{{ $product->code }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Satuan</label>
                            <select class="form-control select2bs4" name="unit" style="width: 100%;">
                                <option>{{ $product->unit }}</option>
                                <option>Box</option>
                                <option>Ball</option>
                                <option>Pack</option>
                                <option>Pcs</option>
                                <option>Unit</option>
                                <option>Set</option>
                                <option>Gln</option>
                                <option>Btl</option>
                                <option>Gram</option>
                                <option>Tube</option>
                                <option>Vial</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="desc" class="form-control" rows="3" value="{{ $product->desc }}">
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

@push('script')
<script>
    $(function () {
        $(document).ready(function(){
            $('.uang').mask('000.000.000', {reverse: true});
        })
    });
</script>
@endpush