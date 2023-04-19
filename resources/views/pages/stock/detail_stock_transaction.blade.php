<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detail Barang Keluar/Masuk </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align:middle;"><center>Tanggal</center></th>
                        <th rowspan="2" style="vertical-align:middle;"><center>Invoice</center></th>
                        <th colspan="2" style="vertical-align:middle;"><center>Jumlah</center></th>
                    </tr>
                    <tr>
                        <th><center>Masuk</center></th>
                        <th><center>Keluar</center></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalIn = 0;
                    $totalOut = 0;
                    @endphp

                    @foreach($detail as $item)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                        <td>{{ $item->invoice }}</td>
                        @if(isset($item->type))
                            @if($item->type == 'out')
                            <td><center>-</center></td>
                            <td><center>{{ $item->qty }}</center></td>
                            @php $totalOut += $item->qty; @endphp
                            @else
                            <td><center>{{ $item->qty }}</center></td>
                            <td><center>-</center></td>
                            @php $totalIn += $item->qty; @endphp
                            @endif
                        @endif
                        @if(isset($item->status))
                            @if($item->status == 'print')
                            <td><center>-</center></td>
                            <td><center>{{ $item->qty }}</center></td>
                            @php $totalOut += $item->qty; @endphp
                            @elseif($item->status == 'return')
                            <td><center>{{ $item->qty }}</center></td>
                            <td><center>-</center></td>
                            @php $totalIn += $item->qty; @endphp
                            @endif
                        @endif
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" style="text-align:right;"><b>Total</b></td>
                        <td><center><b>{{ $totalIn }}</b></center></td>
                        <td><center><b>{{ $totalOut }}</b></center></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><b>Saldo</b></td>
                        <td colspan="2"><center><b>{{ $totalIn - $totalOut }}</b></center></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->