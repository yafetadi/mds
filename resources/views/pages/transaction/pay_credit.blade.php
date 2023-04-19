<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Bayar Hutang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('credit.pay', $credit->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Invoice</label>
                        <input type="text" class="form-control" name="address" value="{{ $credit->invoice }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Kekurangan</label>
                        <input type="text" class="form-control uang" name="address" value="{{ $credit->remaining }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Nominal</label>
                        <input type="text" class="form-control uang" name="nominal" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(function () {
        $(document).ready(function(){
            $('.uang').mask('000.000.000', {reverse: true});
        })
    });
</script>