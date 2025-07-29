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
            <a href="/laporan-transaksi-pertahun">Laporan Transaksi per tahun</a>
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
                        <i class="fas fa-calendar"></i>
                    </div>
                </div>
                <div class="col-8 col-stats d-flex flex-column justify-content-start align-items-start">
                    <div class="numbers">
                    </div>
                    <form action="/cetak-laporan-transaksi-pertahun" method="post" target="_blank">
                        <label for="tahun" class="mb-4">Cetak Laporan Transaksi Pertahun</label>
                        <div class="col-12 mb-2">
                            <select name="tahun" id="tahun" class="form-control" required>
                                <option value="">-- Pilih Tahun --</option>
                                <?php
                                    $tahunSekarang = date('Y');
                                    for ($i = $tahunSekarang; $i >= $tahunSekarang - 10; $i--) {
                                        echo "<option value=\"$i\">$i</option>";
                                    }
                                ?>
                            </select>
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