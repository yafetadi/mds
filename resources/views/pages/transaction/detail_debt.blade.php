<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detail Hutang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Supplier</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Subtotal</th>
                        <th>Hutang</th>
                        <th><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 ?>
                    @forelse($detail as $data)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $data->supplier }}</td>
                        <td>{{ $data->invoice }}</td>
                        <td>{{ date('d-M-Y', strtotime($data->date)) }}</td>
                        <td>{{ strrev(implode('.',str_split(strrev(strval( $data->subtotal )),3))) }}</td>
                        <td>{{ strrev(implode('.',str_split(strrev(strval( $data->remaining )),3))) }}</td>
                        <td>
                            <form action="{{ route('debt.edit', $data->id) }}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-sm btn-warning" value="Lunasi">
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7"><center>Tidak ada data!</center></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->