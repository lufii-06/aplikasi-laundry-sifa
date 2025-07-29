<?php
    $user = session()->get('user');
?>

<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">

            <a href="/" class="text-white ms-5 ms-lg-0 logo">
                Dita |<b>Landry</b>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item
                    <?php echo uri_string() === '' ? 'active' : '' ?>">
                    <a href="/">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if ($user && isset($user->level) && ($user->level === 'ADMIN')): ?>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master Menu</h4>
                </li>
                <li class="nav-item
                    <?php echo uri_string() === 'pelanggan' ? 'active' : '' ?>">
                    <a href="/pelanggan">
                        <i class="fas fa-users"></i>
                        <p>Pelanggan</p>
                    </a>
                </li>
                <li class="nav-item
                    <?php echo uri_string() === 'jenis-layanan' ? 'active' : '' ?>">
                    <a href="/jenis-layanan">
                        <i class="fas fa-concierge-bell"></i>
                        <p>Jenis Layanan</p>
                    </a>
                </li>
                <li class="nav-item
                <?php echo uri_string() === 'jenis-cucian' ? 'active' : '' ?>">
                    <a href="/jenis-cucian">
                        <i class="fas fa-tshirt"></i>
                        <p>Jenis Cucian</p>
                    </a>
                </li>

                <?php endif; ?>
                <?php if ($user && isset($user->level) && in_array($user->level, ["ADMIN", "PELANGGAN"])): ?>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Transaction Menu</h4>
                </li>
                <li class="nav-item
                <?php echo uri_string() === 'cucian-masuk' ? 'active' : '' ?>">
                    <a href="/cucian-masuk">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Cucian Masuk</p>
                    </a>
                </li>
                <li class="nav-item
                <?php echo uri_string() === 'cucian-selesai' ? 'active' : '' ?>">
                    <a href="/cucian-selesai">
                        <i class="fas fa-history"></i>
                        <p>Riwayat Cucian</p>
                    </a>
                </li>
                <?php endif; ?>
                <?php if ($user && isset($user->level) && ($user->level === 'ADMIN' || $user->level === 'PIMPINAN')): ?>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Laporan</h4>
                </li>
                <li class="nav-item
                    <?php echo uri_string() === 'laporan-pelanggan' ? 'active' : '' ?>">
                    <a href="/laporan-pelanggan">
                        <i class="fas fa-users"></i>
                        <p>Laporan Pelanggan</p>
                    </a>
                </li>
                <li class="nav-item
                      <?php echo uri_string() === 'laporan-jenis-layanan' ? 'active' : '' ?>">
                    <a href="/laporan-jenis-layanan">
                        <i class="fas fa-concierge-bell"></i>
                        <p>Laporan Jenis Layanan</p>
                    </a>
                </li>
                <li class="nav-item
                      <?php echo uri_string() === 'laporan-jenis-cucian' ? 'active' : '' ?>">
                    <a href="/laporan-jenis-cucian">
                        <i class="fas fa-tshirt"></i>
                        <p>Laporan Jenis Cucian</p>
                    </a>
                </li>
                <li class="nav-item
                      <?php echo uri_string() === 'laporan-transaksi-cucian-masuk' ? 'active' : '' ?>">
                    <a href="/laporan-transaksi-cucian-masuk">
                        <i class="fas fa-shopping-basket"></i>
                        <p>Laporan Cucian Masuk</p>
                    </a>
                </li>
                <li class="nav-item
                <?php echo strpos(uri_string(), 'laporan-transaksi') === 0 ? 'active' : '' ?>">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Laporan Transaksi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/laporan-transaksi-pertanggal">
                                    <span class="sub-item">Per Tanggal</span>
                                </a>
                            </li>
                            <li>
                                <a href="/laporan-transaksi-perbulan">
                                    <span class="sub-item">Per Bulan</span>
                                </a>
                            </li>
                            <li>
                                <a href="/laporan-transaksi-pertahun">
                                    <span class="sub-item">Per Tahun</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>