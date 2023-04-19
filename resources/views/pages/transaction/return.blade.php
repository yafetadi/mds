<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detail Transaksi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('return.store', $details[0]->order_id) }}" method="POST">
        @csrf
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <td style="background-color: whitesmoke;">Invoice</tde=>
                    <td style="font-style: italic;">{{ $details[0]->invoice }}</td>
                    <td style="background-color: whitesmoke;">Tanggal</td>
                    <td style="font-style: italic;">{{ date('d-m-Y H:i:s', strtotime($details[0]->updated_at)) }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Pelanggan</td>
                    <td style="font-style: italic;">{{ $details[0]->customer_name }}</td>
                    <td style="background-color: whitesmoke;">Salesman</td=>
                    <td style="font-style: italic;">{{ $details[0]->user_name }}</td>
                </tr>
                <tr>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <label>Daftar Barang:</label>
                </div>
            </div>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Disc</th>
                        <th>Jumlah Beli</th>
                        <th>Jumlah Retur</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $no = 0 ?>
                    @foreach($details as $key => $data)
                    <input type="hidden" name="addProduct[{{$key}}][order_detail_id]" value="{{ $data->id }}">
                    <input type="hidden" name="addProduct[{{$key}}][product_id]" value="{{ $data->product_id }}">
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $data->product_code }}</td>
                        <td>{{ $data->product_name }}</td>
                        <td>{{ strrev(implode('.',str_split(strrev(strval( $data->price )),3))) }}</td>
                        <td>{{ $data->disc }} %</td>
                        <td>{{ $data->qty }}</td>
                        <td><input type="number" class="form-control" name="addProduct[{{$key}}][return]" value="0" min="0" max="{{ $data->qty }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin akan retur faktur ini?')"><i class="fa fa-edit"></i> Retur</button>
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->