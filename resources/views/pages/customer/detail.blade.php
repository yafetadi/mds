@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Pelanggan</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-success float-right" href="{{ route('customer.list') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td style="background-color: whitesmoke;">Nama</tde=>
                                <td style="font-style: italic;">{{ $customer->name }}</td>
                                <td style="background-color: whitesmoke;">Perusahaan</td>
                                <td style="font-style: italic;">{{ $customer->company }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke;">Tenor</td>
                                <td style="font-style: italic;">{{ $customer->tenor }}</td>
                                <td style="background-color: whitesmoke;">Salesman</td>
                                <td style="font-style: italic;">{{ $customer->salesman->name }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke;">Telepon</td>
                                <td style="font-style: italic;">{{ $customer->phone }}</td>
                                <td style="background-color: whitesmoke;">Alamat</td=>
                                <td style="font-style: italic;">{{ $customer->address }} - {{ $customer->city }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke; font-weight: bold;" colspan="2">Jumlah Transaksi</td>
                                <td style="font-style: italic;" colspan="2">{{ $total_order }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke; font-weight: bold;" colspan="2">Total Nominal Transaksi</td>
                                <td style="font-style: italic;" colspan="2">Rp. {{ strrev(implode('.',str_split(strrev(strval( $total_grandtotal )),3))) }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke; font-weight: bold;" colspan="2">Total Nominal Hutang</td>
                                <td style="font-style: italic;" colspan="2">Rp. {{ strrev(implode('.',str_split(strrev(strval( $total_remaining )),3))) }}</td>
                            </tr>
                        </table>

                        <form method="GET" action="{{ url()->current() }}">
                            <div class="row">
                                <div class="col-md-3">
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
                                <div class="col-md-1">
                                    <div class="col-sm-12">
                                        <label>&nbsp;</label>
                                    </div>
                                    <div class="btn-group col-sm-12">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                        <a class="btn btn-default" href="{{ route('customer.detail', $customer->id) }}"><i class="fas fa-undo"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Daftar Transaksi:</label>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <tbody>
                                @forelse($orders as $order)
                                @if($order->payment_method == 'credit')
                                <tr style="background-color:darkorange; font-weight:bold; color:white;">
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
                                <tr style="background-color:darkgreen; font-weight:bold; color:white;">
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
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
@push('script')
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
</script>
@endpush