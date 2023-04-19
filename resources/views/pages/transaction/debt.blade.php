@extends('layouts.main')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-12">
        <h1 class="m-0">Daftar Transaksi Kredit</h1>
        </div>
    </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
<div class="card">
        <div class="card-header">
            Filter Pencarian
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="GET" action="{{ url()->current() }}">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Supplier</label>
                                <select class="form-control" name="filter" id="filter">
                                    <option selected disabled>== Pilih Supplier ==</option>
                                    <option value="">Semua Supplier</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="col-md-12">
                        <label>&nbsp;</label>
                    </div>
                    <div class="btn-group col-md-12">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        <button class="btn btn-default" href="{{ route('debt.list') }}"><i class="fas fa-undo"></i></button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
            <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Supplier</th>
                    <th>Jumlah Hutang</th>
                    <th>Cabang</th>
                    <th><i class="fa fa-cog"></i></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=0 ?>
                  @forelse($debts as $a)
                  <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $a->supplier }}</td>
                    <td>Rp. <span class="uang">{{ $a->total_debt }}</span></td>
                    <td>{{ $a->branch }}</td>
                    <td><button class="btn btn-info btn-sm" onclick="detail('{{ $a->id }}')"><i class="fa fa-search"></i></button></td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5"><center>Tidak ada data!</center></td>
                  </tr>
                  @endforelse
                  </tbody>
                </table>
                <br>
                <div class="d-flex justify-content-center">
                    {{ $debts->links() }}
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- /.content -->

<div class="modal fade" id="modalDetail" aria-hidden="true">
    <div id="imported-page"></div> 
</div>
@endsection

@push('script')
<script>
    function detail(id) {
        $.get("{{ url('/transaction/debt/detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#modalDetail").modal('show');
        });
    }
</script>
@endpush