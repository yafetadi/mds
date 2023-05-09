@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Operasional</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="card col-md" style="border: 1px solid white;">
        <div class="card-header">
            Data Kategori Operasional
            <button class="btn btn-sm float-right btn-primary" data-toggle="modal" data-target="#modal-input-category"><i class="fa fa-plus"></i> Kategori</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="category-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th class="fit text-center"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <a hidden>{{ $no=0 }}</a>
                    @forelse ($categories as $category)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-warning mx-1" onclick="editCategory('{{$category->id}}')"><i class="fa fa-edit"></i></button>
                                <form action="{{ route('category.delete', $category->id) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger mx-1" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3"><center>Tidak ada data!</center></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            Data Operasional
            <button class="btn btn-sm float-right btn-danger mx-1" data-toggle="modal" data-target="#modal-input"><i class="fa fa-minus mr-1"></i> Operasional</button>
            <button class="btn btn-sm float-right btn-primary mx-1" data-toggle="modal" data-target="#modal-saldo-awal"><i class="fa fa-plus mr-1"></i> Saldo</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {{-- Filter --}}
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
                    <div class="col-md-1">
                        <div class="col-sm-12">
                            <label>&nbsp;</label>
                        </div>
                        <div class="btn-group col-sm-12">
                            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                            <a class="btn btn-default" href="{{ route('operational.list') }}"><i class="fas fa-undo"></i></a>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align:middle;"><center>No.</center></th>
                        <th rowspan="2" style="vertical-align:middle;"><center>Kode</center></th>
                        <th rowspan="2" style="vertical-align:middle;"><center>Tanggal</center></th>
                        <th rowspan="2" style="vertical-align:middle;"><center>Nama</center></th>
                        <th rowspan="2" style="vertical-align:middle;"><center>Kategori</center></th>
                        <th rowspan="2" style="vertical-align:middle;"><center>Keterangan</center></th>
                        <th rowspan="2" style="vertical-align:middle;"><center>PJ</center></th>
                        <th colspan="3" style="vertical-align:middle;"><center>Jumlah</center></th>
                        @can('isManager')
                        <th rowspan="2" style="vertical-align:middle;"><center><i class="fa fa-cog"></i></center></th>
                        @endcan
                    </tr>
                    <tr>
                        <th><center>Debet</center></th>
                        <th><center>Kredit</center></th>
                        <th><center>Saldo</center></th>
                    </tr>
                </thead>
                <tbody>

                    <a hidden>{{ $no=0 }}</a>
                    <tr style="background-color:bisque;">
                        <td colspan="7" style="font-weight: bold;">Sisa saldo :</td>
                        <td colspan="3" class="uang text-right" style="font-weight: bold;">{{ $total }}</td>
                        @can('isManager')
                        <td></td>
                        @endcan
                    </tr>
                    @foreach($operationalss as $item)
                    <tr>
                        <td class="text-center">{{ ++$no }}</td>
                        <td class="text-center">{{ $item->code }}</td>
                        <td class="text-center">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                        <td class="text-center">{{ $item->name }}</td>
                        <td class="text-left">{{ $item->operational_category->name }}</td>
                        <td class="text-left">{{ $item->desc }}</td>
                        <td class="text-center">{{ $item->user->name }}</td>
                        @if(isset($item->type))
                            @if($item->type == 'in')
                            <td class="uang text-right">{{ $item->nominal }}</td>
                            <td><center>-</center></td>
                            @php $total += $item->nominal; @endphp
                            <td class="text-right">{{ number_format($total, 0, ',', '.') }}</td>
                            @else
                            <td><center>-</center></td>
                            <td class="uang text-right">{{ $item->nominal }}</td>
                            @php $total -= $item->nominal; @endphp
                            <td class="text-right">{{ number_format($total, 0, ',', '.') }}</td>
                            @endif
                        @endif
                        @can('isManager')
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm" onclick="edit('{{ $item->id }}')"><i class="fa fa-edit"></i></button>
                            <form action="{{ url('/operational/hapus-operational', $item->id) }}" method="get">
                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="modal-input-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('category.store') }}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Kategori Operasional</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Ketikkan ..." required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <br>
                            <span class="text-secondary">
                                *Ketikkan keterangan dengan menggunakan titik dua ( : ) sebagai pemisah antar keterangan.
                                Misalnya : Membeli pena: Membeli penghapus.
                            </span>
                            <br>
                            <br>
                            <textarea name="keterangan" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal -->
<div class="modal fade" id="modal-saldo-awal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('category.saldoAwalStore') }}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tambah Saldo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-md-12">
                        <div class="form-group">
                            <label>CP</label>
                            <div id="wrapper_cp">
                                <select id="pilih_cp" type="text" name="name" class=" form-control select2bs4">
                                    <option disabled selected>== Pilih CP ==</option>
                                    @foreach($cpSales as $c)
                                    <option value="{{ $c }}">{{ $c }}</option>
                                    @endforeach
                                    @foreach($cpUser as $u)
                                    <option value="{{ $u }}">{{ $u }}</option>
                                    @endforeach
                                    <option value="ketik-sendiri">...</option>
                                </select>
                            </div>
                            <input type="text" name="namess" id="cps" class="form-control d-none" placeholder="Ketikkan CP disini...">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text"class="form-control" value="Tambah Saldo" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangansss" id="keterangansss" class="form-control" placeholder="Ketikkan keterangan disini...">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="hidden" id="operational_category_id" name="operational_category_id" value="{{ $ambilATM }}">
                            <label>Nominal</label>
                            <input type="text" name="saldo" class="form-control uang" placeholder="Masukan jumlah saldo..." required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-input">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('operational.store') }}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Operasional</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>CP</label>
                            <div id="wrapper_cp">
                                <select id="pilih_cp" type="text" name="name" class="select2bs4">
                                    <option disabled selected>== Pilih CP ==</option>
                                    @foreach($cpSales as $cpSales)
                                    <option value="{{ $cpSales }}">{{ $cpSales }}</option>
                                    @endforeach
                                    @foreach($cpUser as $cpUser)
                                    <option value="{{ $cpUser }}">{{ $cpUser }}</option>
                                    @endforeach
                                    <option value="ketik-sendiri">...</option>
                                </select>
                            </div>
                            <input type="text" name="namess" id="cps" class="form-control d-none" placeholder="Ketikkan CP disini...">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select type="text" name="operational_category_id" id="select_category" class="select2bs4">
                                <option disabled selected>== Pilih Kategori ==</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="keteranganss">
                            <label>Keterangan</label>
                            <div id="wrapper-keterangan">
                                <select name="keterangan" id="keterangan" class="select2bs4">
                                    <option value="#" disabled selected>== Pilih Keterangan ==</option>
                                </select>
                            </div>
                            <input type="text" name="keterangans" id="keterangans" class="d-none form-control" placeholder="Ketikkan keterangan disini...">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="text" name="nominal" class="form-control uang" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Edit -->
<div class="modal fade" id="editModal">
    <div id="imported-page"></div>            
</div>

<div class="modal fade" id="editCategoryModal">
    <div id="imported-page-category"></div>            
</div>
<!-- /.modal-edit -->
@endsection

@push('script')
<script>
    // Set category_operational_id
    let operational_category_id = "{{ $ambilATM }}";
    let i = JSON.parse(operational_category_id.replace(/&quot;/g,'"'))
    $('#operational_category_id').val(i[0].id);

    // For Filter
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


    function edit(id) {
        $.get("{{ url('/operational/edit') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#editModal").modal('show');
        });
    }

    function editCategory(id) {
        $.get("{{ url('/operational/category/edit') }}/" + id, {}, function(data,status) {
            $("#imported-page-category").html(data);
            $("#editCategoryModal").modal('show');
        })
    }

    $('#select_category').change(function(){
        let value = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/operational/category/getcategory',
            data: {
                value: value
            },
            success: function(data){
                if(data.name == 'Lain-lain'){
                    $('#wrapper-keterangan').addClass('d-none');
                    $('#keterangans').removeClass('d-none');

                    console.log('berhasil');
                }

                if(data.name != 'Lain-lain'){
                    $('#wrapper-keterangan').removeClass('d-none');
                    $('#keterangans').addClass('d-none');

                    var ex = data.keterangan.split(':')
                    console.log(ex)
                    var result = ex.map(function(e){
                        return `
                            <option name="desc" value="${e}">${e}</option>
                        `
                    });

                    $('#keterangan').html(result);
                    $('#keterangan').append(
                        `
                            <option name="desc" value="custom">...</option>
                        `
                    );
                    console.log('berhasil');
                }

                console.log(data.name)
            },
            error: function(err){
                console.log(err)
            }
        });
    });
    
    $('#keterangan').change(function(){
        if($(this).val() == 'custom'){
            $('#keteranganss').html(
                `
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="Ketikkan keterangan disini..." required>
                `
            )
        }
    });

    $('#pilih_cp').change(function(){
        if($(this).val() == 'ketik-sendiri'){
            $('#wrapper_cp').addClass('d-none');
            $('#cps').removeClass('d-none');
        }
    });
</script>
@endpush