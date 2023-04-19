@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Sales</h1>
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
                    <div class="card-header">
                        Data Salesman
                        <button class="btn btn-sm btn-primary float-sm-right" data-toggle="modal" data-target="#modal-input-sales"><i class="nav-icon fas fa-plus"></i> Salesman</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                    <th>Cabang</th>
                                    <th>Area</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                @forelse($salesmen as $b)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $b->name }}</td>
                                    <td>{{ $b->phone }}</td>
                                    <td>{{ $b->address }}</td>
                                    <td>{{ $b->branch->name }}</td>
                                    <td>{{ $b->area->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-info" href="{{ route('salesman.detail', $b->id) }}"><i class="fas fa-search"></i></a>
                                            <button class="btn btn-sm btn-warning" onClick="getUpdateDetail('{{ $b->id }}')"><i class="fas fa-edit"></i></button>
                                            <form action="{{ route('salesman.delete', $b->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" id="delete-data" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
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
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Modal Edit Salesman -->
<div class="modal fade" id="editModal1">
    <div id="imported-page"></div>            
</div>
<!-- /.modal-edit-salesman -->

<!-- Modal Input -->
<div class="modal fade" id="modal-input-sales" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Sales</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('salesman.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Telepon</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Cabang</label>
                            <select class="form-control select2bs4" name="branch_id" id="branch" style="width: 100%;">
                                <option disabled>== Pilih Cabang ==</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Area</label>
                            <select class="form-control select2bs4" name="area_id" id="area" style="width: 100%;">
                                <option disabled>== Pilih Area ==</option>
                                @foreach($areas as $area)
                                <option value="{{ $area->id }}" data-chained="{{ $area->branch_id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-input -->
@endsection
@push('script')
<script src="{{ asset('js/jquery_chained.js') }}"></script>
<script>
    $("#area").chained("#branch");

    function getUpdateDetail(id) {
        $.get("{{ url('get-salesman-detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#editModal1").modal('show');
        });
    }

    // function getDetail(id) {
    //     $.get("{{ url('/employee/salesman/detail') }}/" + id, {}, function(data, status) {
    //         $("#imported-page-detail").html(data);
    //         $("#detailModal1").modal('show');
    //     });
    // }
</script>
@endpush