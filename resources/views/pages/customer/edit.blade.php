<div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" action="{{ route('customer.update', $customer->id) }}">
        @csrf
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Pelanggan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" name="company" class="form-control" value="{{ $customer->company }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tenor</label>
                            <input type="number" name="tenor" class="form-control" rows="3" value="{{ $customer->tenor }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="address" class="form-control" rows="3" value="{{ $customer->address }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" name="city" class="form-control" rows="3" value="{{ $customer->city }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Salesman</label>
                            <select class="select2bs4" name="salesman_id">
                                @foreach($salesmen as $salesman)
                                    <option value="{{ $salesman->id }}" {{ $customer->salesman_id == $salesman->id ? 'selected' : '' }}>{{ $salesman->name }} - {{ $salesman->branch->name }} - {{ $salesman->area->name }}</option>
                                @endforeach
                            </select>
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

<script>
    $(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>