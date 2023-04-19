<div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" action="{{ route('price.update', $pricelist->id) }}">
        @csrf
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Harga Produk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <select class="form-control select2bs4" name="product_id" id="product_id" style="width: 100%;" disabled>
                            <option disabled>== Pilih Produk ==</option>
                            @foreach($products as $product)    
                            <option value="{{ $product->id }}" {{ $pricelist->product_id == $product->id ? 'selected' : '' }}>{{ $product->code }} - {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select class="form-control select2bs4" name="customer_id" id="customer_id" style="width: 100%;" disabled>
                            <option disabled>== Pilih Pelanggan ==</option>
                            <option value="" {{ $pricelist->customer_id == 'NULL' ? 'selected' : '' }}>UMUM</option>
                            @foreach($customers as $customer)    
                            <option value="{{ $customer->id }}" {{ $pricelist->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="price" class="form-control uang" value="{{ $pricelist->price }}" required>
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

<script>
    $(function () {
        $(document).ready(function(){
            $('.uang').mask('000.000.000', {reverse: true});
        })
    });
</script>