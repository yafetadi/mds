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
    <div class="card col-md-6">
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
                        <th><i class="fa fa-cog"></i></th>
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
                                <button class="btn btn-sm btn-warning" onclick="editCategory('{{$category->id}}')"><i class="fa fa-edit"></i></button>
                                <form action="{{ route('category.delete', $category->id) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></button>
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
            <button class="btn btn-sm float-right btn-primary" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus"></i> Operasional</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Kategori</th>
                        <th>Cabang</th>
                        <th>PJ</th>
                        <th><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <a hidden>{{ $no=0 }}</a>
                    @forelse ($operationals as $operational)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $operational->name }}</td>
                        <td>{{ $operational->desc }}</td>
                        <td>Rp. <span class="uang">{{ $operational->nominal }}</span>,-</td>
                        <td>{{ $operational->operational_category->name }}</td>
                        <td>{{ $operational->branch->name }}</td>
                        <td>{{ $operational->user->name }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="edit('{{ $operational->id }}')"><i class="fa fa-edit"></i></button>
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
    <div class="modal-dialog modal-lg">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select type="text" name="operational_category_id" class="select2bs4">
                                <option disabled>== Pilih Kategori ==</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="text" name="nominal" class="form-control uang" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="desc" class="form-control">
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
</script>
@endpush