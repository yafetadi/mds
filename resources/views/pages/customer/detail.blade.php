<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detail Pelanggan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <td style="background-color: whitesmoke;">Nama</tde=>
                    <td style="font-style: italic;">{{ $customer->name }}</td>
                    <td style="background-color: whitesmoke;">Perusahaan</td>
                    <td style="font-style: italic;">{{ $customer->company }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Tenor</td>
                    <td style="font-style: italic;">{{ $customer->tenor }}</td>
                    <td style="background-color: whitesmoke;">Salesman</td>
                    <td style="font-style: italic;">{{ $customer->salesman->name }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Telepon</td>
                    <td style="font-style: italic;">{{ $customer->phone }}</td>
                    <td style="background-color: whitesmoke;">Alamat</td=>
                    <td style="font-style: italic;">{{ $customer->address }} - {{ $customer->city }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke; font-weight: bold;" colspan="2">Total Nominal Transaksi</td>
                    <td style="font-style: italic;" colspan="2">Rp. {{ strrev(implode('.',str_split(strrev(strval( $total_grandtotal )),3))) }}</td>
                </tr>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <label>Daftar Transaksi:</label>
                </div>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Invoice</th>
                        <th>Jumlah Barang</th>
                        <th>Grandtotal</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 ?>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                        <td>{{ $order->invoice }}</td>
                        <td>{{ $order->order_detail->sum('qty') }}</td>
                        <td>{{ $order->grandtotal }}</td>
                        <td>{{ $order->payment_method }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6"><center>Tidak ada transaksi</center></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->