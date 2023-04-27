<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Data Transaksi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tbody>
                    <?php $no = 0 ?>
                    @forelse($orders as $order)
                    @if($order->payment_method == 'credit')
                    <tr style="background-color:lightsalmon; font-weight:bold;">
                        <td>Tanggal</td>
                        <td>Invoice</td>
                        <td>Jth Tempo</td>
                        <td>Grandtotal</td>
                        <td>Hutang</td>
                        <td>Pembayaran</td>
                    </tr>
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                        <td>{{ $order->invoice }}</td>
                        <td>{{ date('d-m-Y', strtotime($order->due)) }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $order->grandtotal )),3))) }}</td>
                        <td style="color:red;">
                            Rp. {{ strrev(implode('.',str_split(strrev(strval( $order->credit->whereHas('order', function($query) use ($order) {
                                $query->where('id', $order->id);
                            })->first()->remaining)),3))) }}
                        </td>
                        <td style="font-style: italic;">{{ $order->payment_method }}</td>
                    </tr>
                    @else
                    <tr style="background-color: lightblue; font-weight:bold;">
                        <td>Tanggal</td>
                        <td>Invoice</td>
                        <td>Subtotal</td>
                        <td>Pengiriman</td>
                        <td>Grandtotal</td>
                        <td>Pembayaran</td>
                    </tr>
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                        <td>{{ $order->invoice }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $order->subtotal )),3))) }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $order->delivery )),3))) }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $order->grandtotal )),3))) }}</td>
                        <td style="font-style: italic;">{{ $order->payment_method }}</td>
                    </tr>
                    @endif
                    <tr style="background-color:whitesmoke; font-weight:bold;">
                        <td colspan="2">Produk</td>
                        <td>Jumlah</td>
                        <td>Harga</td>
                        <td>Diskon</td>
                        <td>Total</td>
                    </tr>
                        @foreach($order_detail->where('order_id', $order->id) as $data)
                        <tr>
                            <td colspan="2">{{ $data->product->code }} - {{ $data->product->name }}</td>
                            <td>{{ $data->qty }}</td>
                            <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $data->price )),3))) }}</td>
                            <td>{{ $data->disc }} %</td>
                            <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $data->total )),3))) }}</td>
                        </tr>
                        @endforeach
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