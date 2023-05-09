<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detail Barang {{ $details[0]->type == 'in' ? 'Masuk' : 'Keluar' }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <td style="background-color: whitesmoke;">Tanggal</td>
                    <td style="font-style: italic;">{{ date('d-m-Y', strtotime($details[0]->date)) }}</td>
                    <td style="background-color: whitesmoke;">Invoice</tde=>
                    <td style="font-style: italic;">{{ $details[0]->invoice }}</td>
                </tr>
                @if(($details[0]->supplier) == null)
                <tr>
                    <td style="background-color: whitesmoke;">Ket.</td>
                    <td colspan="3" style="font-style: italic;" colspan="3">{{ $details[0]->desc }}</td>
                </tr>
                @else
                <tr>
                    <td style="background-color: whitesmoke;">Supplier</tde=>
                    <td style="font-style: italic;">{{ $details[0]->supplier }}</td>
                    <td style="background-color: whitesmoke;">Ket.</td>
                    <td style="font-style: italic;" colspan="3">{{ $details[0]->desc }}</td>
                </tr>
                @endif
                <tr>
                    <td style="background-color: whitesmoke;">Cabang</td>
                    <td style="font-style: italic;">{{ $details[0]->branch_name }}</td>
                    <td style="background-color: whitesmoke;">Dicetak</td=>
                    <td style="font-style: italic;">{{ $details[0]->user_name }}</td>
                </tr>
                @if($details[0]->type == 'in')
                <tr>
                    <td style="background-color: whitesmoke;">Subtotal</td>
                    <td style="font-style: italic;">Rp. {{ strrev(implode('.',str_split(strrev(strval( $details[0]->subtotal )),3))) }}</td>
                    <td style="background-color: whitesmoke;">DP</td>
                    <td style="font-style: italic;">Rp. {{ strrev(implode('.',str_split(strrev(strval( $details[0]->dp )),3))) }}</td>
                    <td style="background-color: whitesmoke;">Piutang</td>
                    <td style="font-style: italic;">Rp. {{ strrev(implode('.',str_split(strrev(strval( $details[0]->remaining )),3))) }}</td>
                </tr>
                @endif
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
                        <th>Jumlah</th>
                        @canany(['isManager','isAdmin','isPurchase'])
                        <th>Harga</th>
                        <th>Kadaluarsa</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 ?>
                    @foreach($details as $data)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $data->product_code }}</td>
                        <td>{{ $data->product_name }}</td>
                        <td>{{ $data->qty }}</td>
                        @canany(['isManager','isAdmin','isPurchase'])
                        <td>Rp. {{ $data->price }}</td>
                        <td>{{ date('d-m-Y', strtotime($data->expired)) }}</td>
                        @endcanany
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->