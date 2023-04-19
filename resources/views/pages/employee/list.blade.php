@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Karyawan</h1>
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
                        Data Admin & Gudang
                        <button class="btn btn-sm btn-primary float-sm-right" data-toggle="modal" data-target="#modal-input-admin"><i class="nav-icon fas fa-plus"></i> Admin/Gudang</button>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                    <th>Cabang</th>
                                    <th>Peran</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                @foreach($employee->where('role', '<>', 'Salesman') as $a)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>{{ $a->branch->name }}</td>
                                        <td>{{ $a->role }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit-{{ $a->id }}"><i class="fas fa-edit"></i></button>
                                                <form action="{{ route('employee.delete', $a->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" id="delete-data" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modal-edit-{{ $a->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Ubah Data</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('employee.update', $a->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label>Nama</label>
                                                                <input type="text" class="form-control" name="name" value="{{ $a->name }}" required>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label>Email</label>
                                                                <input type="email" class="form-control" name="email" value="{{ $a->email }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label>Telepon</label>
                                                                <input type="text" class="form-control" name="phone" value="{{ $a->phone }}" required>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label>Alamat</label>
                                                                <input type="text" class="form-control" name="address" value="{{ $a->address }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label>Cabang</label>
                                                                <select class="form-control select2bs4" name="branch_id" style="width: 100%;">
                                                                    @foreach($branches as $branch)
                                                                    <option value="{{ $branch->id }}" {{ $a->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label>Peran</label>
                                                                <select class="form-control select2bs4" name="role" id="role" style="width: 100%;">
                                                                    @foreach($roles as $role => $name)
                                                                    <option value="{{ $role }}" {{ $role == $a->role ? 'selected' : '' }}>{{ $name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label>Password</label>
                                                                <input type="password" class="form-control" name="password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal-edit -->
                                    @endforeach
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



<!-- Modal Input -->
<div class="modal fade" id="modal-input-admin" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('employee.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Telepon</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Cabang</label>
                            <select class="form-control select2bs4" name="branch_id" style="width: 100%;">
                                <option disabled>== Pilih Cabang ==</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Peran</label>
                            <select class="form-control select2bs4" name="role" id="role" style="width: 100%;">
                                <option disabled>== Pilih Peran ==</option>
                                @foreach($roles as $role => $name)
                                <option value="{{ $role }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
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
</script>
@endpush