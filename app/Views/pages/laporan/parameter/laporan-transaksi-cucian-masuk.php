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
            <a href="/laporan-transaksi-cucian-masuk">Laporan Transaksi Cucian Masuk</a>
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
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                </div>
                <div class="col-8 col-stats d-flex flex-column justify-content-start align-items-start ">
                    <form action="/cetak-laporan-transaksi-cucian-masuk" method="post" target="_blank">
                        <div class="mb-3">
                            <label for="JenisCucian" class="form-label ">Jenis Cucian</label>
                            <select class=" selectpicker  form-control border
                                <?php echo session('errors.id_cucian') ? 'is-invalid' : '' ?>" name="satuan" required
                                id="JenisCucian" data-live-search="true">
                                <option value="" disabled>-- Pilih Jenis Cucian --</option>
                                <?php foreach ($datas as $jenisCucian): ?>
                                <option value="<?php echo $jenisCucian->satuan ?>">
                                    <?php echo $jenisCucian->satuan ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (session('errors.id_cucian')): ?>
                            <div class="invalid-feedback d-block">
                                <?php echo esc(session('errors.id_cucian')) ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm mt-2"><i class="fas fa-print"></i>
                            Cetak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection('content') ?>