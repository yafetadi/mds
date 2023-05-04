<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="#" class="brand-link">
    <img src="{{ asset('logo.png') }}" width="70px" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
    <span class="brand-text font-weight-bold">MDS</span>App
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('user.jpg') }}" class="img-circle elevation-2">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @canany(['isOwner','isManager'])
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
        </li>
        @endcanany
        <li class="nav-header">TRANSAKSI</li>
        @canany(['isManager','isAdmin'])
        <li class="nav-item">
            <a href="{{ route('selling') }}" class="nav-link">
                <i class="nav-icon fas fa-calculator text-green"></i>
                <p>
                Penjualan
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager','isAdmin'])
        <li class="nav-item">
            <a href="{{ route('transaction.history') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-blue"></i>
                <p>
                Daftar Penjualan
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager','isAdmin','isFinance'])
        <li class="nav-item">
            <a href="{{route('transaction.credit') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-orange"></i>
                <p>
                Daftar Piutang
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager','isPurchase'])
        <li class="nav-item">
            <a href="{{ route('stock_in.list') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-purple"></i>
                <p>
                Daftar Pembelian
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager','isPurchase'])
        <li class="nav-item">
            <a href="{{route('debt.list') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-orange"></i>
                <p>
                Daftar Hutang
                </p>
            </a>
        </li>
        @endcanany
        <li class="nav-header">DATA MASTER</li>
        @canany(['isOwner','isManager','isAdmin'])
        <li class="nav-item">
            <a href="{{ route('area.list') }}" class="nav-link">
                <i class="nav-icon fas fa-landmark text-cyan"></i>
                <p>
                Area Sales
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('salesman.list') }}" class="nav-link">
                <i class="nav-icon fas fa-users text-green"></i>
                <p>
                Sales
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager','isPurchase'])
        <li class="nav-item">
            <a href="{{ route('supplier.list') }}" class="nav-link">
                <i class="nav-icon fas fa-users text-green"></i>
                <p>
                Supplier
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager','isAdmin'])
        <li class="nav-item">
            <a href="{{ route('customer.list') }}" class="nav-link">
                <i class="nav-icon fas fa-users text-green"></i>
                <p>
                Pelanggan
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager'])
        <li class="nav-item">
            <a href="{{ route('employee.list') }}" class="nav-link">
                <i class="nav-icon fas fa-users text-green"></i>
                <p>
                Karyawan
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager','isAdmin','isPurchase','isGudang'])
        <li class="nav-item">
            <a href="{{ route('product.list') }}" class="nav-link">
                <i class="nav-icon fas fa-tags text-teal"></i>
                <p>
                Produk
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager','isAdmin'])
        <li class="nav-item">
            <a href="{{ route('price.list') }}" class="nav-link">
                <i class="nav-icon fas fa-tags text-teal"></i>
                <p>
                Daftar Harga
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager','isAdmin','isPurchase','isGudang','isFinance'])
        <li class="nav-item">
            <a href="{{ route('catalog.list') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-pink"></i>
                <p>
                Katalog
                </p>
            </a>
        </li>
        @endcanany
        <!-- <li class="nav-item">
            <a href="{{ route('stock_in.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-pink"></i>
                <p>
                Barang Masuk
                </p>
            </a>
        </li> -->
        @canany(['isOwner','isManager','isAdmin'])
        <li class="nav-item">
            <a href="{{ route('stock_out.list') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-pink"></i>
                <p>
                Barang Keluar
                </p>
            </a>
        </li>
        @endcanany

        <li class="nav-header">LAPORAN</li>
        @canany(['isManager','isFinance'])
        <li class="nav-item">
            <a href="{{ route('operational.list') }}" class="nav-link">
                <i class="nav-icon fas fa-shopping-bag text-pink"></i>
                <p>
                Operasional
                </p>
            </a>
        </li>
        @endcanany
        @canany(['isOwner','isManager'])
        <li class="nav-item">
            <a href="{{ route('report.finance') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-blue"></i>
                <p>
                Keuangan
                </p>
            </a>
        </li>
        @endcanany
        <!-- <li class="nav-item">
            <a href="{{ route('report.stock') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-blue"></i>
                <p>
                Barang
                </p>
            </a>
        </li> -->

        <!-- @can('isAdmin')
        <li class="nav-header">TRANSAKSI</li>
        <li class="nav-item">
            <a href="{{ route('selling') }}" class="nav-link">
                <i class="nav-icon fas fa-calculator text-green"></i>
                <p>
                Penjualan
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('transaction.history') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-blue"></i>
                <p>
                Daftar Penjualan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('transaction.credit') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-orange"></i>
                <p>
                Daftar Piutang
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('stock_in.list') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-purple"></i>
                <p>
                Daftar Pembelian
                </p>
            </a>
        </li>

        <li class="nav-header">DATA MASTER</li>
        <li class="nav-item">
            <a href="{{ route('operational.list') }}" class="nav-link">
                <i class="nav-icon fas fa-shopping-bag text-pink"></i>
                <p>
                Operasional
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('supplier.list') }}" class="nav-link">
                <i class="nav-icon fas fa-users text-green"></i>
                <p>
                Supplier
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('customer.list') }}" class="nav-link">
                <i class="nav-icon fas fa-users text-green"></i>
                <p>
                Pelanggan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('product.list') }}" class="nav-link">
                <i class="nav-icon fas fa-tags text-teal"></i>
                <p>
                Produk
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('price.list') }}" class="nav-link">
                <i class="nav-icon fas fa-tags text-teal"></i>
                <p>
                Daftar Harga
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fas fa-table text-pink"></i>
                <p>
                    Stok
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('catalog.list') }}" class="nav-link">
                        <i class="far fa-circle nav-icon text-pink"></i>
                        <p>
                        Katalog
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('stock_out.list') }}" class="nav-link">
                        <i class="far fa-circle nav-icon text-pink"></i>
                        <p>
                        Barang Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-header">LAPORAN</li>
        <li class="nav-item">
            <a href="{{ route('report.finance') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-blue"></i>
                <p>
                Keuangan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('report.stock') }}" class="nav-link">
                <i class="nav-icon fas fa-book text-blue"></i>
                <p>
                Barang
                </p>
            </a>
        </li>
        @endcan

        @can('isGudang')
        <li class="nav-item">
            <a href="{{ route('catalog.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-pink"></i>
                <p>
                Katalog
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('stock_in.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-pink"></i>
                <p>
                Barang Masuk
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('stock_out.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-pink"></i>
                <p>
                Barang Keluar
                </p>
            </a>
        </li>
        @endcan -->
    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>