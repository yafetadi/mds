@extends('layouts.main')
@section('content')
<div ng-controller="CashierController">
    {{ $branch_id = Auth::user()->branch_id <> 1; }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="float-left">Penjualan</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <section class="col-md-4 connectedSortable">
                    <div>
                        <div class="card card-default">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Pelanggan</label>
                                        <div class="input-group">
                                            <!-- <input type="text" ng-if="!isAddOrder" ng-model="input.customer_id" id="customer"
                                                    uib-typeahead="state as state.company for state in customerList | filter:$viewValue | limitTo:10"
                                                    class="form-control"
                                                    typeahead-editable="false"> -->
                                            <select class="form-control select2bs4" ng-if="!isAddOrder" ng-model="input.customer_id" id="customer" ng-options="state as state.company for state in customerList"></select>
                                            <span class="input-group-append">
                                                <button ng-click="addOrderInfo()" class="btn btn-info" ng-if="!isAddOrder"><i class="fas fa-arrow-right"></i></button>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" ng-if="isAddOrder" ng-model="input.customer" disabled>
                                        <input type="hidden" ng-model="input.customer_id">
                                        <label ng-if="errors.customer_id!=null" class="text-danger text-sm">@{{ errors.customer_id }}</label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Invoice</label>
                                        <input type="text" class="form-control" ng-model="input.invoice" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Subtotal</label>
                                        <input type="text" awnum="numericConverter" class="form-control" ng-model="input.subtotal" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Total Disc.</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" ng-model="input.total_disc" readonly ng-disabled="!isAddOrder">
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>
                                    @if($branch_id)
                                    <div class="form-group col-md-12">
                                        <label>PPN</label>
                                        <input type="text" awnum="numericConverter" class="form-control" ng-model="input.total_ppn" readonly ng-disabled="!isAddOrder">
                                    </div>
                                    @endif
                                    <div class="form-group col-md-12">
                                        <label>Biaya Pengiriman</label>
                                        <input type="text" awnum="numericConverter" class="form-control" ng-model="input.delivery" ng-disabled="!isAddOrder">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                            <button class="btn btn-danger float-left" ng-click="removeOrder()" ng-if="isAddOrder" ng-disabled="cancel"><i class="fa fa-trash"></i> Batal</button>
                                <button class="btn btn-info float-right" ng-click="openModalPayment()" ng-if="isAddOrder"><i class="fa fa-check"></i> Proses</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </section>
                
                <section class="col-md-8 connectedSortable">
                    <div>
                        <div class="card card-default">
                            <div class="card-header">
                                <b>Pilih Produk</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <select class="form-control select2bs4" ng-model="itemProduct.product_id" ng-options="item as item.product_name for item in stockList" ng-disabled="!isAddOrder"></select>
                                    </div>
                                    <div class="form-group row col-md-3">
                                        <label class="col-md-4 col-form-label">Qty</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" ng-model="itemProduct.qty" ng-disabled="!isAddOrder">
                                        </div>
                                    </div>
                                </div>
                                <label ng-if="errors.count!=null" class="text-danger text-sm">@{{ errors.count }}</label>
                                <label ng-if="errors.stock!=null" class="text-danger text-sm">@{{ errors.stock }}</label>
                                <label ng-if="errors.product!=null" class="text-danger text-sm">@{{ errors.product }}</label>
                                <label ng-if="errors.pricelist!=null" class="text-danger text-sm">@{{ errors.pricelist }}</label>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success float-right" ng-click="addOrderList()" ng-disabled="!isAddOrder"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div>
                        <!-- general form elements -->
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Qty.</th>
                                        <th>Harga</th>
                                        <th>Disc.</th>
                                        @if($branch_id)
                                        <th>PPN</th>
                                        @endif
                                        <th>Total</th>
                                        <th><i class="fa fa-cog"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in orderList">
                                            <td>@{{ item.product_name }}</td>
                                            <td>@{{ item.qty }} @{{ item.product_unit }}</td>
                                            <td><span awnum="numericConverter">@{{ item.price | currency:"":0}}</span></td>
                                            <td><span id="currency-no-fractions">@{{ item.disc }} %</span></td>
                                            @if($branch_id)
                                            <td><span id="currency-no-fractions">@{{ item.ppn | currency:"":0}}</span></td>
                                            @endif
                                            <td><span id="currency-no-fractions">@{{ item.total | currency:"":0}}</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-warning" title="Ubah" ng-click="editOrderList(item)" ng-disabled="cancel"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-sm btn-danger" title="Hapus" ng-click="removeOrderList(item)" ng-disabled="cancel"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </section>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<!-- Modal Proses Pembayaran -->
<div class="modal fade" id="myModalPayment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <td>Tanggal</td>
                            <td><input class="form-control" type="date" ng-model="input.date"></td>
                        </tr>
                        <tr>
                            <td>Invoice</td>
                            <td><b>@{{ input.invoice }}</b></td>
                        </tr>
                        <tr>
                            <td>Total Disc.</td>
                            <td><b id="currency-no-fractions">@{{ input.total_disc }} %</b></td>
                        </tr>
                        @if($branch_id)
                        <tr>
                            <td>PPN</td>
                            <td><b id="currency-no-fractions">@{{ input.total_ppn | currency:"":0}}</b></td>
                        </tr>
                        @endif
                        <tr>
                            <td>Subtotal</td>
                            <td><b id="currency-no-fractions">@{{ input.subtotal | currency:"":0}}</b></td>
                        </tr>
                        <tr>
                            <td>Biaya Pengiriman</td>
                            <td><b id="currency-no-fractions">@{{ input.delivery | currency:"":0}}</b></td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td><h2><b id="currency-no-fractions">@{{ input.grandtotal | currency:"Rp. ":0}}</b></h2></td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" ng-model="input.payment_method" value="cash">
                            <label for="customRadio1" class="custom-control-label">CASH</label>
                        </div>
                        <div>
                            <input type="text" awnum="numericConverter" id="cash" class="form-control" placeholder="Nominal" ng-model="input.payment" ng-disabled="input.payment_method === 'credit' || input.payment_method === 'transfer'">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" ng-model="input.payment_method" value="credit">
                            <label for="customRadio2" class="custom-control-label">TEMPO</label>
                        </div>
                        <div>
                            <input type="text" awnum="numericConverter" id="credit" class="form-control" placeholder="DP" ng-model="input.payment" ng-disabled="input.payment_method === 'cash' || input.payment_method === 'transfer'">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio3" name="customRadio" ng-model="input.payment_method" value="transfer">
                            <label for="customRadio3" class="custom-control-label">TRANSFER</label>
                        </div>
                        <div>
                            <input type="text" awnum="numericConverter" id="transfer" class="form-control" ng-model="input.payment" ng-disabled="input.payment_method === 'cash' || input.payment_method === 'credit'">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label ng-if="errors.payment!=null" class="text-danger">@{{ errors.payment }}</label>
                    <label ng-if="errors.payment_method!=null" class="text-danger">@{{ errors.payment_method }}</label>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button class="btn btn-default" ng-click="removeOrder()" ng-if="isAddOrder" ng-disabled="cancel"><i class="fa fa-trash"></i> Batal</button>
                <button type="button" class="btn btn-warning" ng-click="newOrder()"><i class="fa fa-undo"></i> Transaksi Baru</button>
                <button type="submit" class="btn btn-danger" ng-click="addPrint()"><i class="fa fa-print"></i> Cetak</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Modal Edit OrderList -->
<div class="modal fade" id="myModalEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Ubah @{{ data.product_name }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Qty</label>
                        <input type="number" class="form-control" min="0" ng-model="data.qty">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Disc.</label>
                        <input type="number" class="form-control" min="0" ng-model="data.disc">
                    </div>
                    @if($branch_id)
                    <div class="form-group col-md-3">
                        <label>PPN</label>
                        <input type="checkbox" class="form-control" ng-model="data.ppn">
                    </div>
                    @endif
                </div>
                <label ng-if="errors.qty!=null" class="text-danger">@{{ errors.qty }}</label>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" ng-click="updateOrderList()"><i class="fa fa-edit"></i> Ubah</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
</div>
@endsection

@push('style')
<style type="text/css">
    .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
        color: #fff;
        text-decoration: none;
        background-color: #337ab7;
        outline: 0;
    }
    .dropdown-menu>li>a {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
    }
</style>
@endpush
@push('script')
<script src="{{ asset('js/print.min.js') }}"></script>
<script src="{{ asset('js/angular.min.js') }}"></script>
<script src="{{ asset('js/dynamic-number.min.js') }}"></script>
<script src="{{ asset('js/ui-bootstrap-tpls-2.5.0.min.js') }}"></script>
<script src="{{ asset('app/app.module.js') }}"></script>
<script src="{{ asset('app/controller/cashier.controller.js') }}"></script>
<script>
    function payMethod() {
        var x = document.getElementById("payment_method").value;
        if(x == "TRANSFER") {
            document.getElementById("payment").disabled = true;
            document.getElementById("payment").value = null;
            document.getElementById("e_money").disabled = false;
        }
        if(x == "CASH") {
            document.getElementById("pay").disabled = false;
            document.getElementById("pay").value = null;
            document.getElementById("e_money").disabled = true;
            document.getElementById("e_money").value = null;
        }
    }
</script>
@endpush
