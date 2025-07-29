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
            <a href="/cucian-selesai">Cucian Selesai</a>
        </li>
    </ul>
</div>
<?php echo $this->endSection('breadcrumb') ?>

<?php echo $this->section('content') ?>
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Data Cucian Selesai</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID Cucian</th>
                                    <th>Jenis Cucian</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Tanggal Diambil</th>
                                    <th>Total Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($datas as $data): ?>
                                <tr>
                                    <td><?php echo "#" . $data->id ?></td>
                                    <td><?php echo $data->nama_cucian ?></td>
                                    <td><?php echo $data->nama_pelanggan ?></td>
                                    <td><?php echo $data->tgl_masuk ?></td>
                                    <td><?php echo $data->tgl_selesai ?? "Belum Selesai" ?></td>
                                    <td><?php echo $data->tgl_ambil ?? "Belum Diambil" ?></td>
                                    <td><?php echo $data->total ?></td>
                                    <td>
                                        <a href="cetak-laporan-faktur-transaksi/<?php echo $data->id ?>" target="_blank"
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
        </div>
    </div>
</div>
<?php echo $this->endSection('content') ?>