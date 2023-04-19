@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Area</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus"></i> Area</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Area</th>
                        <th>Cabang</th>
                        <th><i class="nav-icon fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <a hidden>{{ $no=0 }}</a>
                    @foreach ($areas as $a)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->branch->name }}</td>
                        <td>
                            <form method="POST" action="{{ route('area.delete', $a->id) }}">
                                @csrf
                                @method('delete')
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit-{{ $a->id }}"><i class="fas fa-edit" title="Ubah Data"></i></button>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fas fa-trash" title="Hapus Data"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="modal-edit-{{ $a->id }}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form role="form" method="POST" action="{{ route('area.update', $a->id) }}">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Data Area</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Nama Area</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $a->name }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Cabang</label>
                                                    <select class="select2bs4" name="branch_id">
                                                        <option value="{{ $a->branch_id }}">{{ $a->branch->name }}</option>
                                                        @foreach($branches->where('id', '<>', $a->branch_id) as $branch)
                                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                        @endforeach
                                                    </select>
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
                        @endforeach
                    </div>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</div>
<!-- /.card -->

</section>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="modal-input">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('area.store') }}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Area</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nama Area</label>
                            <input type="text" name="name" class="form-control" placeholder="Ketikkan ..." required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Cabang</label>
                            <select class="select2bs4" name="branch_id">
                                <option disabled>== Pilih Cabang ==</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
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
@endsection