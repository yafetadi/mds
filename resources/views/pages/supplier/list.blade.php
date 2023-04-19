@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12">
                <h1 class="float-left">Daftar Supplier</h1>
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus"></i> Supplier</button>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Cari nama ...">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                <a class="btn btn-default" href="{{ route('customer.list') }}"><i class="fas fa-undo"></i></a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th><i class="nav-icon fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <a hidden>{{ $no=0 }}</a>
                    @forelse ($suppliers as $a)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->phone }}</td>
                        <td>{{ $a->address }}</td>
                        <td>
                            <form method="post" action="{{ route('supplier.delete', $a->id) }}">
                                @method('delete')
                                @csrf
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-warning" onclick="edit('{{ $a->id }}')"><i class="fas fa-edit" title="Ubah Data"></i></button>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></button>
                            </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8"><center>Tidak ada data!</center></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <div class="d-flex justify-content-center">
                {{ $suppliers->links() }}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="modal-input">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('supplier.store') }}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input type="text" name="name" class="form-control" placeholder="Ketikkan ..." required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="phone" class="form-control" placeholder="Ketikkan ..." required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="address" class="form-control" rows="3" placeholder="Ketikkan ..." required>
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

<div class="modal fade" id="modalEdit" aria-hidden="true">
    <div id="imported-page-edit"></div> 
</div>

<div class="modal fade" id="modalDetail" aria-hidden="true">
    <div id="imported-page-detail"></div> 
</div>
@endsection

@push('script')
<script>
    function detail(id) {
        $.get("{{ url('/supplier/detail') }}/" + id, {}, function(data, status) {
            $("#imported-page-detail").html(data);
            $("#modalDetail").modal('show');
        });
    }

    function edit(id) {
        $.get("{{ url('/supplier/edit') }}/" + id, {}, function(data, status) {
            $("#imported-page-edit").html(data);
            $("#modalEdit").modal('show');
        });
    }
</script>
@endpush