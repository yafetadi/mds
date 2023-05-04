<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Operasional</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('operational.update', $operational->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Nominal</label>
                                <input type="text" name="nominal" class="form-control uang" value="{{ $operational->nominal }}" required>
                            </div>
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

<script>
    $(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>