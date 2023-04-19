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
                    <td style="background-color: whitesmoke;">Jatuh Tempo</td>
                    <td style="font-style: italic;">{{ date('d-m-Y', strtotime($details[0]->credit->order->due)) }}</td>
                    <td style="background-color: whitesmoke;">Invoice</td=>
                    <td style="font-style: italic;">{{ $details[0]->credit->order->invoice }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Pelanggan</td>
                    <td style="font-style: italic;">{{ $details[0]->credit->order->customer->company }}</td>
                    <td style="background-color: whitesmoke;">PC</td=>
                    <td style="font-style: italic;">{{ $details[0]->credit->order->customer->name }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Subtotal</td>
                    <td style="font-style: italic;">Rp. {{ strrev(implode('.',str_split(strrev(strval( $details[0]->credit->nominal )),3))) }}</td>
                    <td style="background-color: whitesmoke;">Kekurangan</td=>
                    <td style="font-style: italic; color:red;">Rp. {{ strrev(implode('.',str_split(strrev(strval( $details[0]->credit->remaining )),3))) }}</td>
                </tr>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <label>Daftar Produk:</label>
                </div>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Disc</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=0; @endphp
                    @foreach($order_detail as $data)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $data->product->name }}</td>
                        <td>{{ $data->qty }} {{ $data->product->unit }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $data->price )),3))) }}</td>
                        <td>{{ $data->disc }} %</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $data->total )),3))) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <label>Riwayat Pembayaran Kredit:</label>
                </div>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=0; @endphp
                    @forelse($details as $data)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $data->nominal )),3))) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->