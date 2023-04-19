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
                    <td style="background-color: whitesmoke;">Pelanggan</td>
                    <td style="font-style: italic;">{{ $details[0]->customer_company }}</td>
                    <td style="background-color: whitesmoke;">PC</td=>
                    <td style="font-style: italic;">{{ $details[0]->customer_name }}</td>
                </tr>
                <tr>
                    <td style="background-color: whitesmoke;">Alamat</td>
                    <td style="font-style: italic;">{{ $details[0]->customer_address }}, {{ $details[0]->customer_city }}</td>
                    <td style="background-color: whitesmoke;">Telepon</td=>
                    <td style="font-style: italic;">{{ $details[0]->customer_phone }}</td>
                </tr>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <label>Daftar Transaksi Kredit:</label>
                </div>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Jth Tempo</th>
                        <th>Sales</th>
                        <th>Subtotal</th>
                        <th>Kekurangan</th>
                        <th>Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 ?>
                    @forelse($details as $data)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $data->invoice }}</td>
                        <td>{{ date('d-m-Y', strtotime($data->updated_at)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($data->due)) }}</td>
                        <td>{{ $data->salesman }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $data->grandtotal )),3))) }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $data->remaining )),3))) }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-info" onclick="detailPayment('{{ $data->id }}')"><i class="fa fa-search"></i></button>
                                @if($data->remaining > 0)
                                <button class="btn btn-sm btn-warning" onclick="pay('{{ $data->id }}')">Bayar</button>
                                @else
                                <button class="btn btn-sm btn-success">Lunas</button>
                                @endif
                            </div>
                        </td>
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

<div class="modal fade" id="modalPay" aria-hidden="true">
    <div id="imported-page"></div> 
</div>

<div class="modal fade" id="modalDetailPayment" aria-hidden="true">
    <div id="imported-page-detail"></div> 
</div>

<script>
    function pay(id) {
        $.get("{{ url('/transaction/credit/pay') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#modalPay").modal('show');
        });
    }

    function detailPayment(id) {
        $.get("{{ url('/transaction/credit/detail/payment') }}/" + id, {}, function(data, status) {
            $("#imported-page-detail").html(data);
            $("#modalDetailPayment").modal('show');
        });
    }
</script>