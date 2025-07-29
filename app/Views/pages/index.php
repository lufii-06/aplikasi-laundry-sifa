<?php echo $this->extend('layouts/main') ?>

<?php echo $this->section('breadcrumb') ?>
<div class="page-header my-auto pt-3 d-none d-lg-flex">
    <h3 class="fw-bold mb-3">Dashboard</h3>
    <ul class="breadcrumbs mb-3">
        <li class="nav-home">
            <a href="/">
                <i class="icon-home"></i>
            </a>
        </li>
    </ul>
</div>
<?php echo $this->endSection('breadcrumb') ?>

<?php echo $this->section('content') ?>
<div class="">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div class="">
            <p class="op-7 mb-2">Selamat Datang, Sistem Informasi Laundry</p>
        </div>
        <div
            class="ms-md-auto py-2 py-md-0
            <?php echo(session()->get('user')->level ?? '') === 'ADMIN' || (session()->get('user')->level ?? '') === 'PIMPINAN' ? 'd-block' : 'd-none' ?>">
            <a href="/cucian-masuk" class="btn btn-label-info btn-round me-2
            <?php echo(session()->get('user')->level ?? '') !== 'PIMPINAN' ? '' : 'd-none'; ?>">New Order</a>

            <a href="/pelanggan" class="btn btn-primary btn-round
            <?php echo(session()->get('user')->level ?? '') === 'ADMIN' ? '' : 'd-none'; ?>">Add Customer</a>
        </div>
    </div>
    <div
        class="row
    <?php echo(session()->get('user')->level ?? '') === 'ADMIN' || (session()->get('user')->level ?? '') === 'PIMPINAN' ? '' : 'd-none' ?>">
        <div class="col-sm-6 ">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <a href="/paket">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Paket yang tersedia</p>
                                <h4 class="card-title"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <a href="/pemesanan">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Pesanan telah selesai</p>
                                <h4 class="card-title"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="card card-round
        <?php echo(session()->get('user')->level ?? '') === 'ADMIN' || (session()->get('user')->level ?? '') === 'PIMPINAN' ? '' : 'd-none' ?>">
        <div class="card-header">
            <div class="card-head-row card-tools-still-right">
                <div class="card-title">Riwayat transaksi terbaru</div>
                <div class="card-tools
                <?php echo(session()->get('user')->level ?? '') === 'ADMIN' ? '' : 'd-none'; ?>">
                    <div class="dropdown">
                        <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/cucian-masuk">Transaksi Baru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Id Transaksi</th>
                            <th scope="col" class="text-start">Tanggal Masuk</th>
                            <th scope="col" class="text-start">Tanggal Selesai</th>
                            <th scope="col" class="text-start">Tanggal Ambil</th>
                            <th scope="col" class="text-start">Nama Pelanggan</th>
                            <th scope="col" class="text-start">Total</th>
                            <th scope="col" class="text-start">Status</th>
                            <th scope="col" class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($datas, 0, 10) as $item): ?>
                        <tr>
                            <th scope="row">
                                Dari Pesanan #<?php echo $item->id ?>
                            </th>
                            <td class="text-start"><?php echo $item->tanggal_masuk ?? "Belum diketahui" ?></td>
                            <td class="text-start"><?php echo $item->tanggal_selesai ?? "Belum diketahui" ?></td>
                            <td class="text-start"><?php echo $item->tanggal_ambil ?? "Belum diketahui" ?></td>
                            <td class="text-start"><?php echo $item->nama_pelanggan ?></td>
                            <td class="text-start"><?php echo $item->total ?? 0 ?></td>
                            <td class="text-start">
                                <?php
                                    $status   = $item->status;
                                    $btnClass = '';

                                    switch ($status) {
                                        case 'MASUK':
                                            $btnClass = 'btn btn-sm  btn-primary';
                                            break;
                                        case 'DI PROSES':
                                            $btnClass = 'btn btn-sm  btn-warning';
                                            break;
                                        case 'SELESAI':
                                            $btnClass = 'btn btn-sm btn-success';
                                            break;
                                        case 'SUDAH DI AMBIL':
                                            $btnClass = 'btn btn-secondary';
                                            break;
                                        default:
                                            $btnClass = 'btn btn-light';
                                    }
                                ?>
                                <button class="<?php echo $btnClass ?>" style="white-space: nowrap;">
                                    <?php echo $status; ?>
                                </button>
                            </td>
                            <td>
                                <a href="cetak-laporan-faktur-transaksi/<?php echo $item->id ?>" target="_blank"
                                    class="btn btn-link btn-info">
                                    <i class="fa fa-download"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h3>Cek Estimasi Cucian</h3>
    <form class=" row gap-5" action="/cetak-laporan-transaksi-perid" method="post" target="_blank">
        <div class="col-12 col-md-3">
            <label for="id" class="form-label">ID Faktur</label>
            <input type="text" class="form-control" id="id" name="id" placeholder="Masukkan ID Faktur">
        </div>
        <div class="col-12 col-md-3">
            <label for="nohp" class="form-label">Nohp</label>
            <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Masukkan Nohp">
        </div>

        <div class="col-12 col-md-3">
            <label for="" class="form-label">&nbsp;</label>
            <button class="btn btn-info d-block" type="submit">Cek</button>
        </div>
    </form>
</div>

<?php echo $this->endSection('content') ?>