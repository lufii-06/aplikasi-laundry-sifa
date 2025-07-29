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
            <a href="/laporan-jenis-layanan">Laporan Jenis Layanan</a>
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
                        <i class="fas fa-bell"></i>
                    </div>
                </div>
                <div class="col-8 col-stats d-flex flex-column justify-content-start align-items-start ">
                    <div class="numbers">
                        <p class="card-category">Total Jenis Layanan Saat Ini</p>
                        <h4 class="card-title"><?php echo $data ?></h4>
                    </div>
                    <form action="/cetak-laporan-jenis-layanan" method="post" target="_blank">
                        <label for="jenisLayanan">Cetak Jumlah Jenis Layanan</label>
                        <input type="number" name="jenisLayanan" id="jenisLayanan" max="<?php echo $data ?>" required
                            value="1" min="0" class="form-control">
                        <button type="submit" class="btn btn-info btn-sm mt-2"><i class="fas fa-print"></i>
                            Cetak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection('content') ?>