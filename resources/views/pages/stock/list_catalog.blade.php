@extends('layouts.main')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12">
                <h1 class="float-left">Data Katalog Stok</h1>
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-input-catalog"><i class="nav-icon fas fa-plus"></i> Katalog</button>
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
                        <div class="row">
                            <div class="col-md-12">
                                <form method="GET" action="{{ url()->current() }}">
                                    <div class="input-group mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-arrow-right"></i></span>
                                            </div>
                                            <select class="form-control select2bs4" name="branch_id">
                                                <option disabled>== Pilih Cabang ==</option>
                                                @if(Auth::user()->role == 'Owner')
                                                <option value="" {{ request('branch_id') == 'NULL' ? 'selected' : '' }}>Semua Cabang</option>
                                                @endif
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                            <select class="form-control select2bs4" name="category_id">
                                                <option disabled>== Pilih Kategori ==</option>
                                                <option value="" {{ request('category_id') == 'NULL' ? 'selected' : '' }}>Semua Kategori</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->code }} - {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="search" class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Cari kode / nama produk ...">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                                <a class="btn btn-default" href="{{ route('catalog.list') }}"><i class="fas fa-undo"></i></a>
                                            </span>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Cabang</th>
                                    <th>PJ</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0 ?>
                                @forelse($catalog as $a)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $a->product_code }} - {{ $a->product_name }}</td>
                                    <td>{{ $a->category_name }}</td>
                                    <td>{{ $a->qty }} {{  $a->product_unit  }}</td>
                                    <td>{{ $a->branch_name }}</td>
                                    <td>{{ $a->user->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-info" onclick="detailCatalog('{{ $a->id }}')"><i class="fas fa-search"></i></button>
                                            <!-- <button type="button" class="btn btn-sm btn-warning" onClick="getUpdateDetail('{{ $a->id }}')"><i class="fas fa-edit"></i></button> -->
                                            @can('isOwner')
                                            <form method="post" action="{{ route('catalog.delete', $a->id) }}">
                                            @csrf
                                            @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                            @endcan
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
                        <br>
                        <div class="d-flex justify-content-center">
                            {{ $catalog->links() }}
                        </div>
                    </div>
                </div><!-- /.card -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Modal Input Catalog-->
<div class="modal fade" id="modal-input-catalog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Katalog Stok</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('catalog.store') }}" method="POST">
            @csrf
            <div class="modal-body" id="addCatalogStock">
                <div class="row">
                    <div id="cabang" class="form-group col-md-4">
                        <label>Cabang</label>
                        <select class="form-control select2bs4" name="addCatalog[0][branch_id]">
                            <option disabled>== Pilih Cabang ==</option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-7">
                        <label>Produk</label>
                        <select class="form-control select2bs4" name="addCatalog[0][product_id]">
                            <option disabled>== Pilih Produk ==</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <div class="col-sm-12">
                            <label>&nbsp;</label>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-danger" onClick="addRow()"><i class="fa fa-plus"></i></button>
                        </div>
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

<div class="modal fade" id="modalEditCatalog" aria-hidden="true">
    <div id="imported-page"></div> 
</div>

<div class="modal fade" id="modalDetailCatalog" aria-hidden="true">
    <div id="imported-page-transaction"></div> 
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        @if (Session::get('respons'))
            let response = "{{Session::get('respons')}}"
            response = JSON.parse(response.replace(/(&quot\;)/g,"\""))
            console.log(response)
            for(let i = 0; i < response["success"].length; i++){
                toastr.success(response["success"][i])
            }

            for(let i = 0; i < response["error"].length; i++){
                toastr.error(response["error"][i])
            }
        @endif
    })
</script>
<script>
    var p= 0;
    function getUpdateDetail(id) {
        $.get("{{ url('get-catalog-detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#modalEditCatalog").modal('show');
        });
    }

    function detailCatalog(id) {
        $.get("{{ url('detail-transaction-catalog') }}/" + id, {}, function(data, status) {
            $("#imported-page-transaction").html(data);
            $("#modalDetailCatalog").modal('show');
        });
    }

    function addRow(){
        let branch = "{{ $branches }}";
        let product = "{{ $products }}";

        let branches = JSON.parse(branch.replace(/(&quot\;)/g,"\""));
        let i = branches.map(function(e){
            return `<option value="${e['id']}">${e['name']}</option>`
        });

        let u = JSON.parse(product.replace(/&quot;/ig,'"'));
        let o = u.map(function(o){
            return `<option value="${o['id']}">${o['code']} -${o['name']}</option>`
        });

        ++p;
        
        $('#addCatalogStock').append(`
            <div class="row" id="remove">
            <div id="cabang" class="form-group col-md-4">
                        <label>Cabang</label>
                        <select class="form-control select2bs4" name="addCatalog[${p}][branch_id]">
                            <option disabled>== Pilih Cabang ==</option>
                            ${i}
                        </select>
                    </div>
                    <div class="form-group col-md-7">
                        <label>Produk</label>
                        <select class="form-control select2bs4" name="addCatalog[${p}][product_id]">
                            <option disabled>== Pilih Produk ==</option>
                            ${o}
                        </select>
                    </div>
                    <div class="col-md-1">
                        <div class="col-sm-12">
                            <label>&nbsp;</label>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-danger" onClick="removeRow()"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
            </div>
        `);   

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    }

    function removeRow(){
        $('#remove').remove()
    }
</script>
@endpush