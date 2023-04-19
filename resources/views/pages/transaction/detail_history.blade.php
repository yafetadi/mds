<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detail Transaksi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <td style="background-color: whitesmoke;">Invoice</tde=>
                    <td style="font-style: italic;">{{ $details[0]->invoice }}</td>
                    <td style="background-color: whitesmoke;">Tanggal</td>
                    <td style="font-style: italic;">{{ date('d-m-Y', strtotime($details[0]->date)) }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Pelanggan</td>
                    <td style="font-style: italic;">{{ $details[0]->customer_company }}</td>
                    <td style="background-color: whitesmoke;">Salesman</td=>
                    <td style="font-style: italic;">{{ $details[0]->user_name }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Disc</td>
                    <td style="font-style: italic;">{{ $details[0]->total_disc }} %</td>
                    <td style="background-color: whitesmoke;">PPN</td>
                    <td style="font-style: italic;">Rp. {{ strrev(implode('.',str_split(strrev(strval( $details[0]->total_ppn )),3))) }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Biaya Kirim</td>
                    <td style="font-style: italic;">Rp. {{ strrev(implode('.',str_split(strrev(strval( $details[0]->delivery )),3))) }}</td>
                    <td style="background-color: whitesmoke;">Pembayaran</td>
                    <td style="font-style: italic;">{{ $details[0]->payment_method }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Grandtotal</td>
                    <td colspan="3" style="font-style: italic;">Rp. {{ strrev(implode('.',str_split(strrev(strval( $details[0]->grandtotal )),3))) }}</td>
                </tr>
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
                        <th>Jumlah</th>
                        <th>Disc</th>
                        <th>Total</th>
                        <th>PPN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 ?>
                    @foreach($details as $data)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $data->product_code }}</td>
                        <td>{{ $data->product_name }}</td>
                        <td>{{ strrev(implode('.',str_split(strrev(strval( $data->price )),3))) }}</td>
                        <td>{{ $data->qty }}</td>
                        <td>{{ $data->disc }} %</td>
                        <td>{{ strrev(implode('.',str_split(strrev(strval( $data->total )),3))) }}</td>
                        <td>{{ strrev(implode('.',str_split(strrev(strval( $data->ppn )),3))) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->