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
            <a href="/cucian-masuk">Cucian Masuk</a>
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
                    <h4 class="card-title">Data Cucian Masuk</h4>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Tambah
                        Data</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID Cucian Masuk</th>
                                    <th>Jenis Cucian</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Total Transaksi</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                                    <td><?php echo $data->total ?></td>
                                    <td>
                                        <?php
                                            $status   = $data->status;
                                            $btnClass = '';

                                            switch ($status) {
                                                case 'MASUK':
                                                    $btnClass = 'btn btn-status btn-primary';
                                                    break;
                                                case 'DI PROSES':
                                                    $btnClass = 'btn btn-status btn-warning';
                                                    break;
                                                case 'SELESAI':
                                                    $btnClass = 'btn btn-status btn-success';
                                                    break;
                                                case 'SUDAH DI AMBIL':
                                                    $btnClass = 'btn btn-secondary';
                                                    break;
                                                default:
                                                    $btnClass = 'btn btn-light';
                                            }
                                        ?>
                                        <button data-id="<?php echo $data->id ?>" data-status="<?php echo $status ?>"
                                            data-color="<?php echo $btnClass ?>" class="<?php echo $btnClass ?>"
                                            style="white-space: nowrap;">
                                            <?php echo $status; ?>
                                        </button>

                                    </td>
                                    <td>
                                        <div class="form-button-action align-items-center ">
                                            <button type="button" data-bs-target="#updateModal" data-bs-toggle="modal"
                                                class="btn btn-link btn-primary btn-lg open-edit-modal"
                                                data-id="<?php echo $data->id ?>"
                                                data-id_pelanggan="<?php echo $data->id_pelanggan ?>"
                                                data-tgl_masuk="<?php echo $data->tgl_masuk ?>"
                                                data-tgl_selesai="<?php echo $data->tgl_selesai ?>"
                                                data-tgl_ambil="<?php echo $data->tgl_ambil ?>"
                                                data-status="<?php echo $data->status ?>"
                                                data-id_cucian="<?php echo $data->id_cucian ?>"
                                                data-qty="<?php echo $data->qty ?>"
                                                data-total="<?php echo $data->total ?>" data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                data-id="<?php echo $data->id ?>"
                                                class="btn btn-link btn-danger alert-delete"
                                                data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <a href="cetak-laporan-faktur-transaksi/<?php echo $data->id ?>"
                                                target="_blank" class="btn btn-link btn-info">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
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

<!-- insert modal -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('/cucian-masuk') ?>" method="post">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <!-- Nama Pelanggan -->
                            <div class="mb-3">
                                <label for="id_pelanggan" class="form-label">Nama Pelanggan</label>
                                <select class=" selectpicker  form-control border
                                <?php echo session('errors.id_pelanggan') ? 'is-invalid' : '' ?>" name="id_pelanggan"
                                    id="id_pelanggan" data-live-search="true">
                                    <option value="">-- Pilih Pelanggan --</option>
                                    <?php foreach ($pelanggans as $pelanggan): ?>
                                    <option value="<?php echo $pelanggan->id ?>">
                                        <?php echo $pelanggan->nama ?>
                                        ||<?php echo $pelanggan->jenis_kelamin ?>
                                        ||<?php echo $pelanggan->nohp ?>
                                        ||<?php echo $pelanggan->alamat ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errors.id_pelanggan')): ?>
                                <div class="invalid-feedback d-block">
                                    <?php echo esc(session('errors.id_pelanggan')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Tanggal Masuk -->
                            <div class="mb-3">
                                <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control
                            <?php echo session('errors.tgl_masuk') ? 'is-invalid' : '' ?>" name="tgl_masuk"
                                    value="<?php echo old('tgl_masuk') ?>">
                                <?php if (session('errors.tgl_masuk')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.tgl_masuk')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Tanggal Selesai -->
                            <div class="mb-3">
                                <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" readonly class="form-control
                            <?php echo session('errors.tgl_selesai') ? 'is-invalid' : '' ?>" name="tgl_selesai"
                                    value="<?php echo old('tgl_selesai') ?>">
                                <?php if (session('errors.tgl_selesai')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.tgl_selesai')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control
                            <?php echo session('errors.status') ? 'is-invalid' : '' ?>" readonly name="status"
                                    value="MASUK" placeholder="Masukkan status" value="<?php echo old('status') ?>">
                                <?php if (session('errors.status')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.status')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <!-- Jenis Cucian -->
                            <div class="mb-3">
                                <label for="insertJenisCucian" class="form-label ">Jenis Cucian</label>
                                <select class=" selectpicker  form-control border
                                <?php echo session('errors.id_cucian') ? 'is-invalid' : '' ?>" name="id_cucian"
                                    id="insertJenisCucian" data-live-search="true">
                                    <option value="">-- Pilih Jenis Cucian --</option>
                                    <?php foreach ($jenisCucians as $jenisCucian): ?>
                                    <option value="<?php echo $jenisCucian->id ?>"
                                        data-satuan="<?php echo $jenisCucian->satuan ?>"
                                        data-nama_layanan="<?php echo $jenisCucian->nama_layanan ?>"
                                        data-harga="<?php echo $jenisCucian->harga ?>">
                                        <?php echo $jenisCucian->nama_cucian ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errors.id_cucian')): ?>
                                <div class="invalid-feedback d-block">
                                    <?php echo esc(session('errors.id_cucian')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Nama Layanan -->
                            <div class="mb-3">
                                <label for="nama_layanan" class="form-label ">Nama Layanan</label>
                                <input type="text" readonly class="form-control
                            <?php echo session('errors.nama_layanan') ? 'is-invalid' : '' ?>" name="nama_layanan"
                                    id="insertNamaLayanan" placeholder="Nama Layanan"
                                    value="<?php echo old('nama_layanan') ?>">
                                <?php if (session('errors.nama_layanan')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.nama_layanan')) ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Satuan -->
                            <div class="mb-3">
                                <label for="insertSatuan" class="form-label">Satuan</label>
                                <input type="text" readonly class="form-control
                            <?php echo session('errors.satuan') ? 'is-invalid' : '' ?>" name="satuan" id="insertSatuan"
                                    placeholder=" satuan" value="<?php echo old('satuan') ?>">
                                <?php if (session('errors.satuan')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.satuan')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <!-- Qty -->
                                    <div class="mb-3">
                                        <label for="insertQty" class="form-label">Qty</label>
                                        <input type="number" class="form-control
                             <?php echo session('errors.qty') ? 'is-invalid' : '' ?>" name="qty" id="insertQty" min="1"
                                            value="1" placeholder="Masukkan qty" value="<?php echo old('qty') ?>">
                                        <?php if (session('errors.qty')): ?>
                                        <div class="invalid-feedback">
                                            <?php echo esc(session('errors.qty')) ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- Harga -->
                                    <div class="mb-3">
                                        <label for="insertHarga" class="form-label ">Harga Per Satuan</label>
                                        <input type="text" readonly class="form-control
                             <?php echo session('errors.harga') ? 'is-invalid' : '' ?>" name="harga" id="insertHarga"
                                            placeholder=" harga" value="<?php echo old('harga') ?>">
                                        <?php if (session('errors.harga')): ?>
                                        <div class="invalid-feedback">
                                            <?php echo esc(session('errors.harga')) ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Total -->
                    <div class="mb-3">
                        <label for="insertTotal" class="form-label">Total</label>
                        <input type="text" readonly class="form-control
                             <?php echo session('errors.total') ? 'is-invalid' : '' ?>" name="total" id="insertTotal"
                            placeholder=" total" value="<?php echo old('total') ?>">
                        <?php if (session('errors.total')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.total')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end insert modal -->

<!-- update modal -->
<div class="modal fade" id="updateModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Update Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <!-- Nama Pelanggan -->
                            <div class="mb-3">
                                <label for="updateIdPelanggan" class="form-label">Nama Pelanggan</label>
                                <select class=" selectpicker  form-control border
                                <?php echo session('errors.id_pelanggan') ? 'is-invalid' : '' ?>" name="id_pelanggan"
                                    id="updateIdPelanggan" data-live-search="true">
                                    <option value="">-- Pilih Pelanggan --</option>
                                    <?php foreach ($pelanggans as $pelanggan): ?>
                                    <option value="<?php echo $pelanggan->id ?>">
                                        <?php echo $pelanggan->nama ?>
                                        ||<?php echo $pelanggan->jenis_kelamin ?>
                                        ||<?php echo $pelanggan->nohp ?>
                                        ||<?php echo $pelanggan->alamat ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errors.id_pelanggan')): ?>
                                <div class="invalid-feedback d-block">
                                    <?php echo esc(session('errors.id_pelanggan')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Tanggal Masuk -->
                            <div class="mb-3">
                                <label for="updateTgl_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control
                            <?php echo session('errors.tgl_masuk') ? 'is-invalid' : '' ?>" name="tgl_masuk"
                                    id="updateTgl_masuk" value="<?php echo old('tgl_masuk') ?>">
                                <?php if (session('errors.tgl_masuk')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.tgl_masuk')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Tanggal Selesai -->
                            <div class="mb-3">
                                <label for="updateTgl_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" readonly class="form-control
                            <?php echo session('errors.tgl_selesai') ? 'is-invalid' : '' ?>" name="tgl_selesai"
                                    id="updateTgl_selesai" value="<?php echo old('tgl_selesai') ?>">
                                <?php if (session('errors.tgl_selesai')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.tgl_selesai')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Tanggal Ambil -->
                            <div class="mb-3">
                                <label for="updateTgl_ambil" class="form-label">Tanggal Ambil</label>
                                <input type="date" readonly class="form-control
                            <?php echo session('errors.tgl_ambil') ? 'is-invalid' : '' ?>" name="tgl_ambil"
                                    id="updateTgl_ambil" value="<?php echo old('tgl_ambil') ?>">
                                <?php if (session('errors.tgl_ambil')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.tgl_ambil')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Status -->
                            <div class="mb-3">
                                <label for="updateStatus" class="form-label">Status</label>
                                <input type="text" class="form-control
                            <?php echo session('errors.status') ? 'is-invalid' : '' ?>" readonly name="status"
                                    id="updateStatus" value="MASUK" placeholder="Masukkan status"
                                    value="<?php echo old('status') ?>">
                                <?php if (session('errors.status')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.status')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <!-- Jenis Cucian -->
                            <div class="mb-3">
                                <label for="updateJenisCucian" class="form-label ">Jenis Cucian</label>
                                <select class=" selectpicker  form-control border
                                <?php echo session('errors.id_pelanggan') ? 'is-invalid' : '' ?>" name="id_cucian"
                                    id="updateJenisCucian" data-live-search="true">
                                    <option value="">-- Pilih Jenis Cucian --</option>
                                    <?php foreach ($jenisCucians as $jenisCucian): ?>
                                    <option value="<?php echo $jenisCucian->id ?>"
                                        data-satuan="<?php echo $jenisCucian->satuan ?>"
                                        data-nama_layanan="<?php echo $jenisCucian->nama_layanan ?>"
                                        data-harga="<?php echo $jenisCucian->harga ?>">
                                        <?php echo $jenisCucian->nama_cucian ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errors.id_cucian')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.id_cucian')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- Nama Layanan -->
                            <div class="mb-3">
                                <label for="updateNamaLayanan" class="form-label ">Nama Layanan</label>
                                <input type="text" readonly class="form-control
                            <?php echo session('errors.nama_layanan') ? 'is-invalid' : '' ?>" name="nama_layanan"
                                    id="updateNamaLayanan" id="insertNamaLayanan" placeholder="Nama Layanan"
                                    value="<?php echo old('nama_layanan') ?>">
                                <?php if (session('errors.nama_layanan')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.nama_layanan')) ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Satuan -->
                            <div class="mb-3">
                                <label for="updateSatuan" class="form-label">Satuan</label>
                                <input type="text" readonly class="form-control
                            <?php echo session('errors.satuan') ? 'is-invalid' : '' ?>" name="satuan" id="updateSatuan"
                                    placeholder=" satuan" value="<?php echo old('satuan') ?>">
                                <?php if (session('errors.satuan')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.satuan')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <!-- Qty -->
                                    <div class="mb-3">
                                        <label for="updateQty" class="form-label">Qty</label>
                                        <input type="number" class="form-control
                             <?php echo session('errors.qty') ? 'is-invalid' : '' ?>" name="qty" id="updateQty" min="1"
                                            value="1" placeholder="Masukkan qty" value="<?php echo old('qty') ?>">
                                        <?php if (session('errors.qty')): ?>
                                        <div class="invalid-feedback">
                                            <?php echo esc(session('errors.qty')) ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- Harga -->
                                    <div class="mb-3">
                                        <label for="updateHarga" class="form-label ">Harga Per Satuan</label>
                                        <input type="text" readonly class="form-control
                             <?php echo session('errors.harga') ? 'is-invalid' : '' ?>" name="harga" id="updateHarga"
                                            placeholder=" harga" value="<?php echo old('harga') ?>">
                                        <?php if (session('errors.harga')): ?>
                                        <div class="invalid-feedback">
                                            <?php echo esc(session('errors.harga')) ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Total -->
                            <div class="mb-3">
                                <label for="updateTotal" class="form-label">Total</label>
                                <input type="text" readonly class="form-control
                             <?php echo session('errors.total') ? 'is-invalid' : '' ?>" name="total" id="updateTotal"
                                    placeholder=" total" value="<?php echo old('total') ?>">
                                <?php if (session('errors.total')): ?>
                                <div class="invalid-feedback">
                                    <?php echo esc(session('errors.total')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end update modal -->
<!-- DELETE FORM -->
<form id="deleteForm" method="POST" style="display: none;">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="id" id="deleteId">
</form>
<form id="updateForm" method="POST" style="display: none;">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="status" id="updateStatus">
</form>

<script src="<?php echo base_url() ?>assets/js/core/jquery-3.7.1.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js" defer></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js" defer></script>
<script>
$(document).ready(function() {
    $(function() {
        $('select').selectpicker();
    });

    $("#insertJenisCucian").change(function() {
        const selected = $(this).find(":selected");
        const satuan = selected.data('satuan');
        const nama_layanan = selected.data('nama_layanan');
        const harga = selected.data('harga');
        $("#insertNamaLayanan").val(nama_layanan);
        $("#insertSatuan").val(satuan);
        $("#insertHarga").val(harga);
        //hitung total
        const qty = $('#insertQty').val();
        console.log(qty, harga)
        $("#insertTotal").val(qty * harga);
    });

    $("#insertQty").change(function() {
        const qty = $(this).val();
        const harga = $("#insertHarga").val();
        $("#insertTotal").val(qty * harga);
    });

    $("#updateJenisCucian").change(function() {
        const selected = $(this).find(":selected");
        const satuan = selected.data('satuan');
        const nama_layanan = selected.data('nama_layanan');
        const harga = selected.data('harga');
        $("#updateNamaLayanan").val(nama_layanan);
        $("#updateSatuan").val(satuan);
        $("#updateHarga").val(harga);
        //hitung total
        const qty = $('#updateQty').val();
        $("#updateTotal").val(qty * harga);

    });

    $("#updateQty").change(function() {
        const qty = $(this).val();
        const harga = $("#updateHarga").val();
        $("#updateTotal").val(qty * harga);
    });

    // js untuk delete data
    $(".alert-delete").click(function(e) {
        const id = $(this).data('id');
        swal({
            title: "Yakin Untuk Hapus Data ini ? ",
            text: "Data Akan dihapus secara permanen, ketik ya jika ingin menghapus",
            type: "warning",
            buttons: {
                cancel: {
                    visible: true,
                    text: "Tidak, Batalkan!",
                    className: "btn btn-danger",
                },
                confirm: {
                    text: "Ya, Hapus Sekarang!",
                    className: "btn btn-success",
                },
            },
        }).then((willDelete) => {
            if (willDelete) {
                $("#deleteId").val(id);
                $("#deleteForm").attr("action", "/cucian-masuk/" + id);
                $("#deleteForm").submit();
            } else {
                swal("Data Tidak Jadi Di Hapus!", {
                    buttons: {
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                });
            }
        });
    });
    // js untuk delete data
    $(".btn-status").click(function(e) {
        const id = $(this).data('id');
        const status = $(this).data('status');
        let newStatus;
        switch (status) {
            case "MASUK":
                newStatus = "DI PROSES";
                break;
            case "DI PROSES":
                newStatus = "SELESAI";
                break;
            case "SELESAI":
                newStatus = "SUDAH DI AMBIL";
                break;
            default:
                newStatus = status;
                break;
        }

        const color = $(this).data('color');
        swal({
            title: "Ubah Status Pesanan",
            text: `Perbarui status cucian pelanggan menjadi ${newStatus}`,
            type: "info",
            buttons: {
                cancel: {
                    visible: true,
                    text: "Tidak, Tunggu Dulu!",
                    className: "btn btn-danger",
                },
                confirm: {
                    text: "Ya, Benar!",
                    className: `${color}`,
                },
            },
        }).then((willUpdate) => {
            if (willUpdate) {
                $("#updateStatus").val(status);
                $("#updateForm").attr("action", "/update-status-cucian-masuk/" + id);
                $("#updateForm").submit();
            } else {
                swal("Data Tidak Jadi Di Hapus!", {
                    buttons: {
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                });
            }
        });
    });

    //js update data ke modal
    $('.open-edit-modal').on('click', function() {
        const id = $(this).data('id');
        const idPelanggan = $(this).data('id_pelanggan');
        const tglMasuk = $(this).data('tgl_masuk');
        const tglSelesai = $(this).data('tgl_selesai');
        const tglAmbil = $(this).data('tgl_ambil');
        const status = $(this).data('status');
        const idCucian = $(this).data('id_cucian');
        const qty = $(this).data('qty');
        const total = $(this).data('total');
        $('#updateTgl_masuk').val(tglMasuk);
        $('#updateTgl_selesai').val(tglSelesai);
        $('#updateTgl_ambil').val(tglAmbil);
        $('#updateStatus').val(status);
        $('#updateJenisCucian').selectpicker('val', String(idCucian));
        $('#updateIdPelanggan').selectpicker('val', String(idPelanggan));
        $('#updateQty').val(qty);
        $('#updateTotal').val(total);
        //memasukkan data data jenis cucian
        const selected = $("#updateJenisCucian").find(":selected");
        const satuan = selected.data('satuan');
        const nama_layanan = selected.data('nama_layanan');
        const harga = selected.data('harga');
        $("#updateNamaLayanan").val(nama_layanan);
        $("#updateSatuan").val(satuan);
        $("#updateHarga").val(harga);
        // selesai memasukkan data data jenis cucian
        $('#updateForm').attr('action', '/cucian-masuk/' + id);
    });
    $('#updateModal').on('hidden.bs.modal', function() {
        // Reset semua input
        $(this).find('form')[0].reset();

        // Hapus error class dan pesan validasi
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
    });
});
</script>
<?php echo $this->endSection('content') ?>