@extends('layouts.main')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-12">
        <h1 class="m-0">Daftar Transaksi Kredit</h1>
        </div>
    </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
<div class="card">
        <div class="card-header">
            Filter Pencarian
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="GET" action="{{ url()->current() }}">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Cabang</label>
                            <select class="form-control" name="branch">
                                <option disabled>== Pilih Cabang ==</option>
                                @if(Auth::user()->role == 'Owner')
                                    <option value="" {{ request('branch_id') == 'NULL' ? 'selected' : '' }}>Semua Cabang</option>
                                @endif
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>{{ $branch->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Pelanggan</label>
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Cari pelanggan ...">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                <a class="btn btn-default" href="{{ route('transaction.credit') }}"><i class="fas fa-undo"></i></a>
                            </span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Pembeli</th>
                                <th>Jumlah Kredit</th>
                                <th>Total Kekurangan</th>
                                <th>Cabang</th>
                                <th><i class="fa fa-cog"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $no = ($transaction->currentPage() - 1) * $transaction->perPage() + 1;
                            @endphp
                            @forelse($transaction as $a)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $a->customer_company }}</td>
                                <td>{{ $a->total_credit_transaction }} faktur</span></td>
                                <td>Rp. <span class="uang">{{ $a->total_remaining }}</span></td>
                                <td>{{ $a->branch }}</td>
                                <td><button class="btn btn-info btn-sm" onclick="detail('{{ $a->customer_id }}')"><i class="fa fa-search"></i></button></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6"><center>Tidak ada data!</center></td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <br>
                        <div class="d-flex justify-content-center">
                            {{ $transaction->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

<div class="modal fade" id="modalDetail" aria-hidden="true">
    <div id="imported-page"></div> 
</div>
@endsection

@push('script')
<script>
    // $(document).ready(function() {
    //     $('#date_range').hide();
    //     $('#date_choice').hide();
    //     $('#month_choice').hide();
    //     $('#year_choice').hide();

    //     $('#filter').change(function () {
    //         if($('#filter').val() == 'custom') {
    //             $('#date_range').show();
    //         } else {
    //             $('#date_range').hide();
    //             $('#date_start').val() == null;
    //             $('#date_end').val() == null;
    //         }

    //         if($('#filter').val() == 'Tanggal') {
    //             $('#date_choice').show();
    //         } else {
    //             $('#date_choice').hide();
    //             $('#date_selected').val() == null;
    //         }

    //         if($('#filter').val() == 'Bulan') {
    //             $('#month_choice').show();
    //         } else {
    //             $('#month_choice').hide();
    //             $('#month_selected').val() == null;
    //         }

    //         if($('#filter').val() == 'Tahun') {
    //             $('#year_choice').show();
    //         } else {
    //             $('#year_choice').hide();
    //             $('#year_selected').val() == null;
    //         }
    //     });
    // });

    function detail(id) {
        $.get("{{ url('/transaction/credit/detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#modalDetail").modal('show');
        });
    }
</script>
@endpush