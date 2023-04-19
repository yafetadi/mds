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
                    <tr style="background-color: lightblue; font-weight:bold;">
                        <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                        <td>{{ $order->invoice }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $order->subtotal )),3))) }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $order->delivery )),3))) }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $order->grandtotal )),3))) }}</td>
                        <td>{{ $order->payment_method }}</td>
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
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->