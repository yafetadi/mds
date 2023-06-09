@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12">
                <h1 class="float-left">Daftar Pembelanjaan</h1>
                @if(Auth::user()->role <> 'Owner')
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-input-stock"><i class="nav-icon fas fa-plus"></i> Barang Masuk</button>
                @endif
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
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <select class="form-control" name="filter" id="filter">
                                            <option disabled>== Pilih Tanggal ==</option>
                                            <option value="Hari Ini" {{ request('filter') == 'Hari Ini' ? 'selected' : '' }}>Hari Ini</option>
                                            <option value="Minggu Ini" {{ request('filter') == 'Minggu Ini' ? 'selected' : '' }}>Minggu Ini</option>
                                            <option value="Bulan Ini" {{ request('filter') == 'Bulan Ini' ? 'selected' : '' }}>Bulan Ini</option>
                                            <option value="Tahun Ini" {{ request('filter') == 'Tahun Ini' ? 'selected' : '' }}>Tahun Ini</option>
                                            <option value="Hari Kemarin" {{ request('filter') == 'Hari Kemarin' ? 'selected' : '' }}>Hari Kemarin</option>
                                            <option value="Minggu Kemarin" {{ request('filter') == 'Minggu Kemarin' ? 'selected' : '' }}>Minggu Kemarin</option>
                                            <option value="Bulan Kemarin" {{ request('filter') == 'Bulan Kemarin' ? 'selected' : '' }}>Bulan Kemarin</option>
                                            <option value="Tahun Kemarin" {{ request('filter') == 'Tahun Kemarin' ? 'selected' : '' }}>Tahun Kemarin</option>
                                            <option value="custom" {{ request('filter') == 'custom' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <select class="form-control" name="filter" id="filter">
                                            <option disabled selected>== Pilih Tanggal ==</option>
                                            <option value="Hari Ini">Hari Ini</option>
                                            <option value="Tanggal">Tanggal</option>
                                            <option value="Bulan">Bulan</option>
                                            <option value="Tahun">Tahun</option>
                                            <option value="custom">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2" id="date_choice">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" id="date_selected" name="date_selected" class="form-control">
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
                                                    <option disabled selected>== Pilih Bulan ==</option>
                                                    @foreach($months as $no => $month)
                                                    <option value="{{ $no }}">{{ $month }}</option>
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
                                                    <option disabled selected>== Pilih Tahun ==</option>
                                                    {{ $now = date('Y'); }}
                                                    @for($year = 2023; $year <= $now; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
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
                                                <input type="date" id="date_start" name="date_start" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sampai Tanggal</label>
                                                <input type="date" id="date_end" name="date_end" class="form-control">
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
                                        <a class="btn btn-default" href="{{ route('stock_in.list') }}"><i class="fas fa-undo"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
         
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Invoice</th>
                                    <th>Supplier</th>
                                    <th>Subtotal</th>
                                    <th>Cabang</th>
                                    <th>PJ</th>
                                    <th><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = ($stock_in->currentPage() - 1) * $stock_in->perPage() + 1;
                                @endphp
                                @forelse($stock_in as $in)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ date('d-m-Y', strtotime($in->date)) }}</td>
                                    <td>{{ $in->invoice }}</td>
                                    <td>{{ $in->supplier }}</td>
                                    <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $in->subtotal )),3))) }}</td>
                                    <td>{{ $in->branch_name }}</td>
                                    <td>{{ $in->user_name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-info" onclick="detail('{{ $in->id }}')"><i class="fa fa-search"></i></button>
                                            @canany(['isManager','isAdmin','isPurchase'])
                                            <button class="btn btn-sm btn-warning" onclick="edit('{{ $in->id }}')"><i class="fa fa-edit"></i></button>
                                            @endcanany
                                            <button class="btn btn-sm btn-danger" onclick="print('{{ $in->id }}')"><i class="fa fa-print"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">
                                        <center>Tidak ada data!</center>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <br>
                        <div class="d-flex justify-content-center">
                            {{ $stock_in->links() }}
                        </div>
                    </div>
                </div><!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Modal Input Stock-->
<div class="modal fade" id="modal-input-stock" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pembelian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('stock_in.store') }}" method="POST" id="barangMasuk">
                @csrf
                <div class="modal-body" id="product-container">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Tanggal</label>
                            <input class="form-control" type="date" name="date" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Supplier</label>
                            <select class="form-control select2bs4" name="supplier_id">
                                <option disabled>== Pilih Supplier ==</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Keterangan</label>
                            <input class="form-control" type="text" name="desc" placeholder="Nomor Nota Pembelian/Keterangan lain" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Subtotal</label>
                            <input type="text" class="form-control uang" name="subtotal" id="subtotal" value="0" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>DP</label>
                            <input type="text" class="form-control uang" name="dp" value="0" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Piutang</label>
                            <input type="text" class="form-control uang" name="remaining" value="0" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Product</label>
                            <select class="form-control select2bs4" name="addProduct[0][stock_id]" required>
                                <option disabled>== Pilih Produk ==</option>
                                @foreach($stocks as $product)
                                <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }} - ({{ $product->unit }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="addProduct[0][qty]" id="qty" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="addProduct[0][price]" id="price">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Total</label>
                            <input type="text" class="form-control" name="addProduct[0][total]" id="total" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Kadaluarsa</label>
                            <input type="date" class="form-control" name="addProduct[0][expired]">
                        </div>
                        <div class="form-group col-md-1">
                            <div class="col-md-12">
                            <label>&nbsp;</label>
                            </div>
                            <div class="col-md-12">
                            <button class="btn btn-danger float-right" onclick="addRow()"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal-input -->

<div class="modal fade" id="modalDetail" aria-hidden="true">
    <div id="imported-page"></div> 
</div>

<div class="modal fade" id="modalEdit" aria-hidden="true">
    <div id="imported-page-edit"></div> 
</div>
@endsection

@push('script')
<script src="{{ asset('js/print.min.js') }}"></script>
<script>
    var p = 0;
    $(document).ready(function() {
        $('#date_range').hide();
        $('#date_choice').hide();
        $('#month_choice').hide();
        $('#year_choice').hide();

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

    function addRow() {
        let product = "{{ $stocks }}";
        let u = JSON.parse(product.replace(/&quot;/ig, '"'));
        let o = u.map(function(o) {
            return `<option value="${o['id']}">${o['code']} - ${o['name']} - (${o['unit']})</option>`
        });

        ++p;

        //Check Count Row

        $('#product-container').append(`
            <div class="row" id="remove">
                <div class="form-group col-md-3">
                    <label>Product</label>
                    <select class="form-control select2bs4" name="addProduct[${p}][stock_id]" required>
                        <option disabled>== Pilih Produk ==</option>
                        ${o}
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" name="addProduct[${p}][qty]" id="qty" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="addProduct[${p}][price]" id="price">
                </div>
                <div class="form-group col-md-2">
                    <label>Total</label>
                    <input type="text" class="form-control" name="addProduct[${p}][total]" id="total" readonly>
                </div>
                <div class="form-group col-md-2">
                            <label>Kadaluarsa</label>
                            <input type="date" class="form-control" name="addProduct[${p}][expired]">
                        </div>
                <div class="form-group col-md-1">
                    <div class="col-md-12">
                        <label>&nbsp;</label>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-danger float-right" onclick="removeRow()"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
            </div>
        `);

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $(document).ready(function(){
            $( '.uang' ).mask('000.000.000', {reverse: true});
        }) 
    }

    function removeRow() {
        $('#remove').remove();
    }

    // function count() {
    //     var qty = $('#qty').val();
    //     var price = $('#price').val();
    //     var total = qty * price;
    //     var subtotal =+ total;
        
    //     $('#total').val(total);
    //     $('#subtotal').val(subtotal);
    // }

    $('input[name*="price"], input[name*="qty"]').on('keyup', function(){
        var qty = $('#qty').val();
        var price = $('#price').val();
        var subtotal = $('#subtotal').val();
        var total = qty * price;
        var subtotal = total + subtotal;
        
        $('#total').val(total);
        $('#subtotal').val(subtotal);
    });

    


    function detail(id) {
        $.get("{{ url('/stock/detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#modalDetail").modal('show');
        });
    }

    function edit(id) {
        $.get("{{ url('/stock/edit') }}/" + id, {}, function(data, status) {
            $("#imported-page-edit").html(data);
            $("#modalEdit").modal('show');
        });
    }

    function print(id) {
        $.get("{{ url('/stock/print') }}/" + id, {}, function(response) {
            printJS({ printable: response['filename'], type: 'pdf', base64: true });
        });
    }
</script>
@endpush