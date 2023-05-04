@extends('layouts.main')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-12">
        <h1 class="m-0">Daftar Transaksi</h1>
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <select class="form-control" name="filter" id="filter">
                                <option disabled {{ request('filter') == null ? 'selected' : '' }}>== Pilih Tanggal ==</option>
                                <option value="Hari Ini" {{ request('filter') == 'Hari Ini' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="Tanggal" {{ request('filter') == 'Tanggal' ? 'selected' : '' }}>Tanggal</option>
                                <option value="Bulan" {{ request('filter') == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                                <option value="Tahun" {{ request('filter') == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                                <option value="custom" {{ request('filter') == 'custom' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="date_choice">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" id="date_selected" name="date_selected" class="form-control" value="{{ request('date_selected') == null ? '' : request('date_selected') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" id="month_choice">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select id="month_selected" name="month_selected" class="form-control">
                                        <option disabled {{ request('month_selected') == null ? 'selected' : '' }}>== Pilih Bulan ==</option>
                                        @foreach($months as $no => $month)
                                        <option value="{{ $no }}" {{ request('month_selected') == $no ? 'selected' : '' }}>{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" id="year_choice">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select id="year_selected" name="year_selected" class="form-control">
                                        <option disabled {{ request('year_selected') == null ? 'selected' : '' }}>== Pilih Tahun ==</option>
                                        {{ $now = date('Y'); }}
                                        @for($year = 2023; $year <= $now; $year++)
                                        <option value="{{ $year }}" {{ request('year_selected') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="date_range">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dari Tanggal</label>
                                    <input type="date" id="date_start" name="date_start" class="form-control" value="{{ request('date_start') == null ? '' : request('date_start') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sampai Tanggal</label>
                                    <input type="date" id="date_end" name="date_end" class="form-control" value="{{ request('date_end') == null ? '' : request('date_end') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>No Faktur</label>
                            <input type="text" class="form-control" name="invoice" value="{{ request('invoice') == null ? '' : request('invoice') }}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="col-sm-12">
                            <label>&nbsp;</label>
                        </div>
                        <div class="btn-group col-sm-12">
                            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                            <a class="btn btn-default" href="{{ route('transaction.history') }}"><i class="fas fa-undo"></i></a>
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
            <div class="card-header">
                <span id="title-excel">Transaksi @if(request()->get('filter') != 'custom') {{ $date }} @elseif (request()->get('filter') == 'custom') {{ $date }} @endif </span>
            </div>
            <div class="card-body">
            <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Invoice</th>
                    <th>Pembeli</th>
                    <th>Grandtotal</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Cabang</th>
                    <th>Sales</th>
                    <th><i class="fa fa-cog"></i></th>
                  </tr>
                  </thead>
                  <tbody>
                  @php
                    $no = ($transaction->currentPage() - 1) * $transaction->perPage() + 1;
                  @endphp
                  @forelse($transaction as $a)
                  <tr {{ $a->status == 'return' ? 'style=background:lightyellow;' : '' }}>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($a->date)) }}</td>
                    <td>{{ $a->invoice }}</td>
                    <td>{{ $a->customer_company }}</td>
                    @if($a->status == 'return')
                    <td colspan="3"><center>Retur dari {{ $a->return }}</center></td>
                    @else
                    <td>Rp. <span class="uang">{{ $a->grandtotal }}</span>,-</td>
                    <td style="text-transform: capitalize; {{ $a->payment_method == 'cash' ? 'color:green;' : 'color:darkorange;' }}">{{ $a->payment_method }}</td>
                        @if($a->payment_method == 'cash')
                        <td style="color:green;">Lunas</td>
                        @elseif($a->payment_method == 'credit' && App\Models\Credit::where('order_id', $a->id)->first()->status == 'Lunas')
                        <td style="color:green;">Lunas</td>
                        @elseif($a->payment_method == 'credit' && App\Models\Credit::where('order_id', $a->id)->first()->status == 'Belum Lunas')
                        <td style="color:red;">Belum Lunas</td>
                        @endif
                    @endif
                    <td>{{ $a->branch }}</td>
                    <td>{{ $a->user_name }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-info btn-sm" onclick="detail('{{ $a->id }}')"><i class="fa fa-search"></i></button>
                            @if($a->status == 'print')
                            <button class="btn btn-warning btn-sm" onclick="edit('{{ $a->id }}')"><i class="fa fa-undo"></i></button>
                            @endif
                            <button class="btn btn-danger btn-sm" onclick="print('{{ $a->id }}')"><i class="fa fa-print"></i></button>
                        </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="9"><center>Tidak ada data!</center></td>
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

<div class="modal fade" id="modalReturn" aria-hidden="true">
    <div id="imported-page-return"></div> 
</div>
@endsection

@push('script')
<script src="{{ asset('js/print.min.js') }}"></script>

<script>
    $(document).ready(function() {
        if($('#filter').val() == 'custom') {
            $('#date_range').show();
        } else {
            $('#date_range').hide();
            $('#date_start').val() == null;
            $('#date_end').val() == null;
        }

        if($('#filter').val() == 'Tanggal') {
            $('#date_choice').show();
        } else {
            $('#date_choice').hide();
            $('#date_selected').val() == null;
        }

        if($('#filter').val() == 'Bulan') {
            $('#month_choice').show();
        } else {
            $('#month_choice').hide();
            $('#month_selected').val() == null;
        }

        if($('#filter').val() == 'Tahun') {
            $('#year_choice').show();
        } else {
            $('#year_choice').hide();
            $('#year_selected').val() == null;
        }

        $('#filter').change(function () {
            if($('#filter').val() == 'custom') {
                $('#date_range').show();
            } else {
                $('#date_range').hide();
                $('#date_start').val() == null;
                $('#date_end').val() == null;
            }

            if($('#filter').val() == 'Tanggal') {
                $('#date_choice').show();
            } else {
                $('#date_choice').hide();
                $('#date_selected').val() == null;
            }

            if($('#filter').val() == 'Bulan') {
                $('#month_choice').show();
            } else {
                $('#month_choice').hide();
                $('#month_selected').val() == null;
            }

            if($('#filter').val() == 'Tahun') {
                $('#year_choice').show();
            } else {
                $('#year_choice').hide();
                $('#year_selected').val() == null;
            }
        });
    });

    function detail(id) {
        $.get("{{ url('/transaction/history/detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#modalDetail").modal('show');
        });
    }

    function edit(id) {
        $.get("{{ url('/transaction/history/return') }}/" + id, {}, function(data, status) {
            $("#imported-page-return").html(data);
            $("#modalReturn").modal('show');
        });
    }

    function print(id) {
        $.get("{{ url('transaction/history/print') }}/" + id, {}, function(response) {
            printJS({ printable: response['filename'], type: 'pdf', base64: true });
        });
    }
</script>
@endpush