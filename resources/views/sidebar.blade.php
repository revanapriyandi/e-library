<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('dashboard') }}">Lib</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
            <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Starter</li>
        <li>
            <a href="#" class="nav-link"><i class="fa fa-align-center"></i>
                <span>Format</span></a>
        </li>
        <li>
            <a class="nav-link" href="#"><i class="fa fa-database"></i>
                <span>Rak</span></a>
        </li>
        <li>
            <a class="nav-link" href="#"><i class="fa fa-book"></i>
                <span>Katalog</span></a>
        </li>
        <li>
            <a class="nav-link" href="#"><i class="fa fa-upload"></i>
                <span>Penerbit</span></a>
        </li>
        <li>
            <a class="nav-link" href="#"><i class="fa fa-user-edit"></i>
                <span>Penulis</span></a>
        </li>
        <li class="menu-header">Pustaka</li>
        <li>
            <a class="nav-link" href="#"><i class="fa fa-book-open"></i>
                <span>Pustaka</span></a>
        </li>
        <li>
            <a class="nav-link" href="#"><i class="fa fa-cloud-upload-alt"></i>
                <span>Peminjaman</span></a>
        </li>
        <li>
            <a class="nav-link" href="#"><i class="fa fa-cloud-download-alt"></i>
                <span>Pengembalian</span></a>
        </li>
        <li>
            <a class="nav-link" href="#"><i class="fa fa-desktop"></i>
                <span>Aktifitas</span></a>
        </li>
    </ul>

    <div class="p-3 mt-4 mb-4 hide-sidebar-mini">
        <a href="" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fa fa-cogs"></i> Pengaturan
        </a>
    </div>
</aside>
