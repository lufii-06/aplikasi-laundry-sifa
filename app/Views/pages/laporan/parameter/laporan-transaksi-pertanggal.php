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
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="/laporan-transaksi-pertanggal">Laporan Transaksi pertanggal</a>
        </li>
    </ul>
</div>
<?php echo $this->endSection('breadcrumb') ?>

<?php echo $this->section('content') ?>
<div class="">
    <div class="card card-stats card-primary card-round">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="icon-big text-center">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                <div class="col-8 col-stats d-flex flex-column justify-content-start align-items-start">
                    <div class="numbers">
                    </div>
                    <form action="/cetak-laporan-transaksi-pertanggal" method="post" target="_blank">
                        <p class="mb-2 d-block">Cetak Laporan Transaksi Pertanggal</p>
                        <div class="mb-3">
                            <label for="tgl_awal">Tanggal Awal</label>
                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required
                                placeholder="Tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="tgl_akhir">Tanggal Akhir</label>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required
                                placeholder="Tanggal">
                        </div>
                        <button type="submit" class="btn btn-info btn-sm mt-2">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection('content') ?>