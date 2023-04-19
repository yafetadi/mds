<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Data Pembelian</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('stock_in.update', $stocks[0]->id) }}" method="POST">
            @csrf
            <div class="modal-body" id="product-container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Tanggal</label>
                        <input class="form-control" type="date" name="date" value="{{ $stocks[0]->date }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Supplier</label>
                        <select class="form-control select2bs4" name="suppier_id">
                            <option disabled>== Pilih Supplier ==</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $stocks[0]->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-md-6">
                        <label>Keterangan</label>
                        <input class="form-control" type="text" name="desc" value="{{ $stocks[0]->desc }}" placeholder="Nomor Nota Pembelian/Keterangan lain" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Subtotal</label>
                        <input type="text" class="form-control uang" name="subtotal" value="{{ $stocks[0]->subtotal }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>DP</label>
                        <input type="text" class="form-control uang" name="dp" value="{{ $stocks[0]->dp }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Piutang</label>
                        <input type="text" class="form-control uang" name="remaining" value="{{ $stocks[0]->remaining }}" required>
                    </div>
                </div>
                @foreach($stocks as $key => $stock)
                <div class="row">
                    <input type="hidden" name="addProduct[{{$key}}][stock_id]" value="{{ $stock->stock_id }}">
                    <div class="form-group col-md-4">
                        <label>Product</label>
                        <input type="text" class="form-control" value="{{ $stock->product_code }} - {{ $stock->product_name }}" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="addProduct[{{$key}}][qty]" value="{{ $stock->qty }}" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Harga</label>
                        <input type="text" class="form-control uang" name="addProduct[{{$key}}][price]" value="{{ $stock->price }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Kadaluarsa</label>
                        <input type="date" class="form-control" name="addProduct[{{$key}}][expired]" value="{{ $stock->expired }}">
                    </div>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('script')
<script>
    $(function () {
        $(document).ready(function(){
            $( '.uang' ).mask('000.000.000', {reverse: true});
        })
    }); 
</script>
@endpush