@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Produk</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-info" data-toggle="modal" data-target="#modal-category">Kategori Produk</button>
            <div class="btn-group float-right">
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus"></i> Produk</button>
                <button class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-trashed"><i class="fa fa-recycle"></i></button>
            </div>
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
                                    <option value="" {{ request('category_id') == 'NULL' ? 'selected' : '' }}>Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->code }} - {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input type="search" class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Cari nama produk ...">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                <a class="btn btn-default" href="{{ route('product.list') }}"><i class="fas fa-undo"></i></a>
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
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th><i class="nav-icon fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <a hidden>{{ $no=0 }}</a>
                    @forelse ($products as $a)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $a->code }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->category->name }}</td>
                        <td>{{ $a->unit }}</td>
                        <td>
                            <form method="POST" action="{{ route('product.delete', $a->id) }}">
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
                {{ $products->links() }}
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
            <form role="form" method="POST" action="{{ route('product.store') }}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kategori Produk</label>
                            <select class="form-control select2bs4" name="category_id" id="category_id" style="width: 100%;">
                                <option disabled>== Pilih Kategori ==</option>
                                @foreach($categories as $category)    
                                <option value="{{ $category->id }}">{{ $category->code }} - {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Satuan</label>
                            <select class="form-control select2bs4" name="unit" style="width: 100%;">
                                <option disabled>== Pilih Satuan ==</option>
                                <option>Box</option>
                                <option>Ball</option>
                                <option>Pack</option>
                                <option>Pcs</option>
                                <option>Unit</option>
                                <option>Set</option>
                                <option>Gln</option>
                                <option>Btl</option>
                                <option>Gram</option>
                                <option>Tube</option>
                                <option>Vial</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="desc" class="form-control" rows="3">
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

<!-- Modal Category -->
<div class="modal fade" id="modal-category">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daftar Kategori Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-input-category"><i class="fa fa-plus"></i> Kategori</button>
                <table class="table table-bordered table-striped" id="category-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th><i class="nav-icon fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <a hidden>{{ $no=0 }}</a>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $category->code }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form method="POST" action="{{ route('category_product.delete', $category->id) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fas fa-trash" title="Hapus Data"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Input Category -->
<div class="modal fade" id="modal-input-category">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST" action="{{ route('category_product.store') }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" maxlength="3" name="code" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Trashed -->
<div class="modal fade" id="modal-trashed">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daftar Produk Dihapus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="category-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>PIC</th>
                            <th><i class="nav-icon fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <a hidden>{{ $no=0 }}</a>
                        @forelse ($trashed_products as $trashed)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $trashed->code }}</td>
                            <td>{{ $trashed->name }}</td>
                            <td>{{ $trashed->user->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('product.recycle', $trashed->id) }}" type="button" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anda yakin akan memunculkan data ini lagi?')"><i class="fas fa-recycle" title="Hapus Permanen"></i></a>
                                    <a href="{{ route('product.forceDelete', $trashed->id) }}" type="button" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini secara PERMANEN?')"><i class="fas fa-trash" title="Hapus Permanen"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5"><center>Tidak ada yang dihapus!</center></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
        $.get("{{ url('get-product-detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#editModalProduct").modal('show');
        });
    }
</script>
@endpush