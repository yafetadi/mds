@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Harga Produk</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            @can('isAdmin')
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus"></i> Harga Produk</button>
            @endcan
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="input-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <select class="form-control select2bs4" name="category_id">
                                    <option disabled>== Pilih Kategori ==</option>
                                    <option value="NULL" {{ request('category_id') == 'NULL' ? 'selected' : '' }}>Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->code }} - {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input type="search" class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Cari nama produk ...">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                <a class="btn btn-default" href="{{ route('price.list') }}"><i class="fas fa-undo"></i></a>
                            </span>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Pelanggan</th>
                        <th>Cabang</th>
                        <th>PJ</th>
                        <th><i class="nav-icon fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <a hidden>{{ $no=0 }}</a>
                    @forelse ($pricelists as $a)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $a->product_code }} - {{ $a->product_name }}</td>
                        <td>Rp. <span class="uang">{{ $a->price }}</span>,-</td>
                        <td>
                            @if(isset($a->customer_company))
                            {{ $a->customer_company }}
                            @else
                            UMUM
                            @endif
                        </td>
                        <td>{{ $a->branch_name }}</td>
                        <td>{{ $a->user_name }}</td>
                        <td>
                            <form method="POST" action="{{ route('price.delete', $a->id) }}">
                                @csrf
                                @method('delete')
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-warning" onClick="getUpdateDetail('{{ $a->id }}')"><i class="fas fa-edit" title="Ubah Data"></i></button>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fas fa-trash" title="Hapus Data"></i></button>
                                </div>
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
            <br>
            <div class="d-flex justify-content-center">
                {{ $pricelists->links() }}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<!-- Modal Edit Product -->
<div class="modal fade" id="editModalProduct">
    <div id="imported-page"></div> 
</div>
<!-- /.modal-edit-product -->

<!-- Modal Product -->
<div class="modal fade" id="modal-input">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('price.store') }}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Harga Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <select class="form-control select2bs4" name="product_id" id="product_id" style="width: 100%;">
                                <option disabled>== Pilih Produk ==</option>
                                @foreach($products as $product)    
                                <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Pelanggan</label>
                            <select class="form-control select2bs4" name="customer_id" id="customer_id" style="width: 100%;">
                                <option disabled>== Pilih Pelanggan ==</option>
                                <option value="">UMUM</option>
                                @foreach($customers as $customer)    
                                <option value="{{ $customer->id }}">{{ $customer->company }} - {{ $customer->city }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="price" class="form-control uang" value="0" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@push('script')
<script>
    function getUpdateDetail(id) {
        $.get("{{ url('get-pricelist-detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#editModalProduct").modal('show');
        });
    }
</script>
@endpush