<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detail Barang Keluar/Masuk: {{ $product_name->product->name }}</h4>
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
                        <th rowspan="2" style="vertical-align:middle;"><center>Nama</center></th>
                        <th colspan="3" style="vertical-align:middle;"><center>Jumlah</center></th>
                    </tr>
                    <tr>
                        <th><center>Masuk</center></th>
                        <th><center>Keluar</center></th>
                        <th><center>Saldo</center></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total = 0;
                    @endphp

                    @foreach($detail as $item)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                        <td>{{ $item->invoice }}</td>
                        <td>{{ $item->company }}</td>
                        @if(isset($item->type))
                            @if($item->type == 'out')
                            <td><center>-</center></td>
                            <td><center>{{ $item->qty }}</center></td>
                            @php $total -= $item->qty; @endphp
                            <td><center>{{ $total }}</center></td>
                            @else
                            <td><center>{{ $item->qty }}</center></td>
                            <td><center>-</center></td>
                            @php $total += $item->qty; @endphp
                            <td><center>{{ $total }}</center></td>
                            @endif
                        @endif
                        @if(isset($item->status))
                            @if($item->status == 'print')
                            <td><center>-</center></td>
                            <td><center>{{ $item->qty }}</center></td>
                            @php $total -= $item->qty; @endphp
                            <td><center>{{ $total }}</center></td>
                            @elseif($item->status == 'return')
                            <td><center>{{ $item->qty }}</center></td>
                            <td><center>-</center></td>
                            @php $total += $item->qty; @endphp
                            <td><center>{{ $total }}</center></td>
                            @endif
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->