(function() {

    'use strict';

    angular.module("cashierApp", ['ui.bootstrap'])
        .controller("CashierController", CashierController);

    CashierController.$inject = ['$http', '$scope'];

    function CashierController($http, $scope) {
        const params = new URLSearchParams(window.location.search)
        const id = params.get('id');
        $scope.isAddOrder = id != null? true : false;
        $scope.errors = [];
        $scope.stockList = [];
        $scope.orderList = [];
        $scope.itemProduct = {};

        initInput();
        getCustomerList();
        $scope.disabled = true;
        $scope.cancel = false;

        function initInput() {
            $scope.input = {
                "product_id": "",
                "subtotal": 0,
                "disc": 0,
                "ppn": 0,
                "delivery": 0,
                "payment_method": "",
                "payment": 0,
            }

            $scope.data = {
                "disc": 0,
                "ppn": "",
                "qty": 0
            }
        }

        if($scope.isAddOrder) {
            initHeaderOrder();
        }

        function getCustomerList() {
            $http.get("/list-customer").then(res => {
                $scope.customerList = res.data.customerList;
            })
        }
        
        function getStockList() {
            $http.get("/list-stock").then(res => {
                $scope.stockList = res.data.stockList;
            })
        }

        function initHeaderOrder() {
            $http.get("/find-order-by-id/"+id).then(res => {
                $scope.input = res.data.order;
                $scope.itemProduct = { qty: 1 };
                $scope.input = { payment:0, delivery: 0 };
                $scope.input.customer = res.data.order.customer_company;
                $scope.input.customer_id = res.data.order.customer_id;
                $scope.input.invoice = res.data.order.invoice;
                getStockList();
                getOrderList();
                getSubtotal();
                getDisc();
                getPpn();
            })
        }

        $scope.addOrderInfo = function () {
            var input = {};
            input.customer_id = $scope.input.customer_id.id;
            $http.post("/add-orderinfo", input).then(res => {
                $scope.errors = res.data.errorList;
                window.location.href = "/selling/?id=" + res.data.order.id;
            })
        }

        $scope.addOrderList = function () {
            var input = {};
            input.customer_id = $scope.input.customer_id;
            input.product_id = $scope.itemProduct.product_id.product_id;
            input.qty        = $scope.itemProduct.qty;
            console.log(input.customer_id);
            $http.post("/add-orderlist/"+id, input).then(res => {
                $scope.errors = res.data.errorList;
                $scope.itemProduct = {};
                initHeaderOrder();
            })
        }

        function getOrderList() {
            $http.get("/list-order/"+id).then(res => {
                $scope.orderList = res.data.orderList;
            })
        }

        $scope.removeOrderList = function (item) {
            $http.post("/remove-orderlist", item).then(res => {
                initHeaderOrder();
            })
        }

        $scope.removeOrder = function () {
            $http.post("/remove-order/"+id).then(res => {
                window.location.href="/selling/"
            })
        }

        $scope.addPrint = function () {
            var input = {};
            input.subtotal       = $scope.input.subtotal;
            input.disc           = $scope.input.total_disc;
            input.ppn            = $scope.input.total_ppn;
            input.delivery       = $scope.input.delivery;
            input.grandtotal     = $scope.input.grandtotal;
            input.payment        = $scope.input.payment;
            input.payment_method = $scope.input.payment_method;
            input.date           = $scope.input.date;
            $http.post("/print/"+id, input).then(res => {
                $scope.errors = res.data.errorList;
                printJS({printable: res.data["filename"], type:'pdf', showModal:true, base64: true});
                $scope.disabled = false;
                $scope.cancel = true;
            })
        }

        $scope.newOrder = function () {
            window.location.href="/selling/"
        }

        function getSubtotal() {
            $http.get('/subtotal/'+id).then(res => {
                $scope.input.subtotal = res.data.subtotal;
            })
        }

        function getDisc() {
            $http.get('/disc/'+id).then(res => {
                $scope.input.total_disc = res.data.total_disc;
            })
        }

        function getPpn() {
            $http.get('/ppn/'+id).then(res => {
                $scope.input.total_ppn = res.data.total_ppn;
            })
        }

        $scope.updateOrderList = function() {
            $http.post('/update-orderlist', $scope.data).then(res => {
                if(res.data.success == false) {
                    $scope.errors = res.data.errorList;
                } else {
                    initHeaderOrder();
                    $('#myModalEdit').modal('hide');
                }
            })
        }

        $scope.openModalPayment = function () {
            $scope.input.grandtotal = parseInt($scope.input.total_ppn) + parseInt($scope.input.delivery) + parseInt($scope.input.subtotal);
            $('#myModalPayment').modal();
        }

        $scope.editOrderList = function(item) {
            $scope.data = angular.copy(item);
            $('#myModalEdit').modal();
        }
    }

})();
