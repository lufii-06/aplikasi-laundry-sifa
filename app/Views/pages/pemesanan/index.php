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
            <a href="/pemesanan">Pemesanan</a>
        </li>
    </ul>
</div>
<?php echo $this->endSection('breadcrumb') ?>

<?php echo $this->section('content') ?>
<?php
    $user = session()->get('user');
?>
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" preload />
<style>
.selectpicker[disabled],
.bootstrap-select.disabled .dropdown-toggle {
    background-color: #e9ecef !important;
    color: #6c757d !important;
    cursor: not-allowed;
    opacity: 1;
}
</style>

<!-- JS -->

<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Data Pemesanan</h4>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Tambah
                        Data</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Paket Yang Diambil</th>
                                    <th>Jam</th>
                                    <th>Lokasi</th>
                                    <th>Status Pemesanan</th>
                                    <th>Status Jadwal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($datas as $data): ?>
                                <tr>
                                    <td><?php echo "#" . $data->id ?></td>
                                    <td><?php echo $data->tanggal ?></td>
                                    <td><?php echo $data->nama_user ?></td>
                                    <td><?php echo $data->nama_paket ?></td>
                                    <td><?php echo $data->jam ?></td>
                                    <td><?php echo $data->lokasi ?></td>
                                    <td>
                                        <?php if ($data->status === "SUDAH BAYAR BELUM KONFIRMASI"): ?>
                                        <button class="btn btn-sm btn-warning btn-konfirmasi text-nowrap">
                                            <?php echo $data->status; ?>
                                        </button>

                                        <?php elseif ($data->status === "SUDAH KONFIRMASI BAYAR"): ?>
                                        <button data-id="<?php echo $data->id ?>"
                                            class="btn btn-sm btn-success btn-selesai
                                            <?php echo empty($data->nama_karyawan) || $user->status == "PELANGGAN" ? 'disabled' : '' ?> text-nowrap">
                                            <?php echo empty($data->nama_karyawan) ? 'Karyawan Belum ditugaskan' : $data->status; ?>
                                        </button>

                                        <?php elseif ($data->status === "SELESAI"): ?>
                                        <button class="btn btn-sm btn-info text-nowrap">
                                            <?php echo $data->status; ?>
                                        </button>

                                        <?php else: ?>
                                        <button class="btn btn-sm btn-danger btn-belum-bayar text-nowrap">
                                            <?php echo $data->status; ?>
                                        </button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <?php $status = session()->get('user')->status; ?>
<?php if (empty($data->nama_karyawan)): ?>
<?php if ($status === 'ADMIN' && $data->status !== "SELESAI"): ?>
                                            <button type="button"
                                                class="btn btn-warning btn-sm open-set-karyawan-modal text-nowrap"
                                                data-bs-toggle="modal" data-bs-target="#setKaryawanModal"
                                                data-id="<?php echo $data->id ?>"
                                                data-user_id="<?php echo $data->user_id ?>"
                                                data-paket_id="<?php echo $data->paket_id ?>"
                                                data-tanggal="<?php echo $data->tanggal ?>"
                                                data-lokasi="<?php echo $data->lokasi ?>"
                                                data-jam="<?php echo $data->jam ?>"
                                                data-status="<?php echo $data->status ?>"
                                                data-original-title="Edit Task">
                                                Tugaskan Karyawan
                                            </button>
                                            <?php elseif ($status === 'PELANGGAN'): ?>
                                            <button type="button" class="btn btn-warning btn-sm text-nowrap">
                                                Fotografer Belum Di Tugaskan
                                            </button>
                                            <?php endif; ?>
<?php elseif ($data->status !== "SELESAI"): ?>
                                            <button type="button" class="btn btn-success btn-sm text-nowrap">
                                                Fotografer <span
                                                    class="text-decoration-underline"><?php echo $data->nama_karyawan ?></span>
                                                Sudah Di Tugaskan
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <?php if ($data->status === "BELUM BAYAR" && session()->get('user')->status === 'PELANGGAN'): ?>
                                            <!-- Tombol Edit -->
                                            <button type="button"
                                                class="btn btn-link btn-primary btn-lg open-edit-modal"
                                                data-bs-toggle="modal" data-bs-target="#updateModal"
                                                data-id="<?php echo $data->id ?>"
                                                data-user_id="<?php echo $data->user_id ?>"
                                                data-paket_id="<?php echo $data->paket_id ?>"
                                                data-tanggal="<?php echo $data->tanggal ?>"
                                                data-jam="<?php echo $data->jam ?>"
                                                data-lokasi="<?php echo $data->lokasi ?>"
                                                data-status="<?php echo $data->status ?>"
                                                data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <?php endif; ?>
<?php if ($data->status == "BELUM BAYAR"): ?>
                                            <button type="button" data-id="<?php echo $data->id ?>"
                                                class="btn btn-link btn-danger alert-delete"
                                                data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <?php endif; ?>
                                            <a href="cetak-pemesanan/<?php echo $data->id ?>" target="_blank"
                                                data-id="<?php echo $data->id ?>" class="btn btn-link btn-info">
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
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('/pemesanan') ?>" method="post">
                    <!-- Nama Pelanggan -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pelanggan</label>
                        <?php if ($user && isset($user->status) && $user->status === 'PELANGGAN'): ?>
                        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                        <?php endif; ?>
                        <select class="selectpicker form-control border
                            <?php echo session('errors.user_id') ? 'is-invalid' : '' ?>" name="user_id"
                            data-live-search="true"
                            <?php echo($user && isset($user->status) && $user->status === 'PELANGGAN') ? 'disabled' : ''; ?>>
                            <option value="">-- Pilih Pelanggan --</option>
                            <?php foreach ($pelanggans as $pelanggan):
                                    $selected = '';
                                    if (
                                    ($user && $user->status === 'PELANGGAN' && $pelanggan->id == $user->id) ||
                                    (old('user_id') == $pelanggan->id)
                                ) {
                                        $selected = 'selected';
                                    }
                                ?>
	                            <option value="<?php echo $pelanggan->id ?>"<?php echo $selected; ?>>
	                                <?php echo $pelanggan->detail_name ?> -<?php echo $pelanggan->nohp ?>
	                            </option>
	                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.user_id')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.user_id')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Paket</label>
                        <select class=" selectpicker  form-control border
                        <?php echo session('errors.paket_id') ? 'is-invalid' : '' ?>" name="paket_id"
                            data-live-search="true">
                            <option value="">-- Pilih Paket --</option>
                            <?php foreach ($pakets as $paket): ?>
                            <option value="<?php echo $paket->id ?>"
                                <?php echo old('paket_id') == $paket->id ? 'selected' : '' ?>>
                                <?php echo $paket->nama ?> -<?php echo $paket->harga ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.paket_id')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.paket_id')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control
            <?php echo session('errors.tanggal') ? 'is-invalid' : '' ?>" name="tanggal"
                            placeholder="Masukkan tanggal Acara" value="<?php echo old('tanggal') ?>">
                        <?php if (session('errors.tanggal')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.tanggal')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Jam -->
                    <div class="mb-3">
                        <label for="jam" class="form-label">Jam</label>
                        <input type="time" class="form-control
            <?php echo session('errors.jam') ? 'is-invalid' : '' ?>" name="jam" placeholder="Masukkan jam "
                            value="<?php echo old('jam') ?>">
                        <?php if (session('errors.jam')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.jam')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- lokasi -->
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <textarea class="form-control
                            <?php echo session('errors.lokasi') ? 'is-invalid' : '' ?>" name="lokasi"
                            placeholder="Masukkan lokasi "><?php echo old('lokasi') ?></textarea>
                        <?php if (session('errors.lokasi')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.lokasi')) ?>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Update Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="updateForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" value="PUT">
                    <?php if ($user && isset($user->status) && $user->status === 'PELANGGAN'): ?>
                    <input type="hidden" name="user_id" id="update_user_id">
                    <?php endif; ?>

                    <!-- Nama Pelanggan -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pelanggan</label>
                        <select
                            <?php echo $user && isset($user->status) && ($user->status === 'PELANGGAN') ? 'disabled' : '' ?>
                            class=" selectpicker  form-control border
                        <?php echo session('errors.user_id') ? 'is-invalid' : '' ?>" name="user_id" id="user_id"
                            data-live-search="true">
                            <option value="">-- Pilih Pelanggan --</option>
                            <?php foreach ($pelanggans as $pelanggan): ?>
                            <option value="<?php echo $pelanggan->id ?>"
                                <?php echo old('user_id') == $pelanggan->id ? 'selected' : '' ?>>
                                <?php echo $pelanggan->detail_name ?>-<?php echo $pelanggan->nohp ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.user_id')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.user_id')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Nama Paket -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Paket</label>
                        <select class=" selectpicker  form-control border
                        <?php echo session('errors.paket_id') ? 'is-invalid' : '' ?>" name="paket_id" id="paket_id"
                            data-live-search="true">
                            <option value="">-- Pilih Paket --</option>
                            <?php foreach ($pakets as $paket): ?>
                            <option value="<?php echo $paket->id ?>"
                                <?php echo old('paket_id') == $paket->id ? 'selected' : '' ?>>
                                <?php echo $paket->nama ?> -<?php echo $paket->harga ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.paket_id')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.paket_id')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control
            <?php echo session('errors.tanggal') ? 'is-invalid' : '' ?>" name="tanggal" id="tanggal"
                            placeholder="Masukkan tanggal Acara" value="<?php echo old('tanggal') ?>">
                        <?php if (session('errors.tanggal')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.tanggal')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Jam -->
                    <div class="mb-3">
                        <label for="jam" class="form-label">Jam</label>
                        <input type="time" class="form-control
            <?php echo session('errors.jam') ? 'is-invalid' : '' ?>" name="jam" id="jam" placeholder="Masukkan jam "
                            value="<?php echo old('jam') ?>">
                        <?php if (session('errors.jam')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.jam')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- lokasi -->
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <textarea class="form-control
                            <?php echo session('errors.lokasi') ? 'is-invalid' : '' ?>" id="lokasi" name="lokasi"
                            placeholder="Masukkan lokasi "><?php echo old('lokasi') ?></textarea>
                        <?php if (session('errors.lokasi')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.lokasi')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- lokasi -->
                    <div class="mb-3">
                        <label for="status" class="form-label">status</label>
                        <input type="text" disabled class="form-control" name="status" id="status">
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end update modal -->

<!-- set karyawan modal -->
<div class="modal fade" id="setKaryawanModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Jadwalkan Karyawan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="updateFormKaryawan" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="pemesanan_id">
                    <!-- Nama Pelanggan -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pelanggan</label>
                        <select class=" selectpicker  form-control border " disabled id="setKaryawanUser_id"
                            data-live-search="true">
                            <option value="">-- Pilih Pelanggan --</option>
                            <?php foreach ($pelanggans as $pelanggan): ?>
                            <option value="<?php echo $pelanggan->id ?>">
                                <?php echo $pelanggan->detail_name ?>-<?php echo $pelanggan->nohp ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Nama Paket -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Paket</label>
                        <select class=" selectpicker  form-control border" id="setKaryawanPaket_id" disabled
                            data-live-search="true">
                            <option value="">-- Pilih Paket --</option>
                            <?php foreach ($pakets as $paket): ?>
                            <option value="<?php echo $paket->id ?>">
                                <?php echo $paket->nama ?> -<?php echo $paket->harga ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="setKaryawanTanggal" disabled
                            placeholder="Masukkan tanggal Acara">
                    </div>
                    <!-- Jam -->
                    <div class="mb-3">
                        <label for="jam" class="form-label">Jam</label>
                        <input type="time" class="form-control" id="setKaryawanJam" placeholder="Masukkan jam" disabled>
                    </div>
                    <!-- lokasi -->
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <textarea class="form-control" id="setKaryawanLokasi" name="lokasi" disabled
                            placeholder="Masukkan lokasi "></textarea>
                    </div>
                    <!-- lokasi -->
                    <div class="mb-3">
                        <label for="status" class="form-label">status</label>
                        <input type="text" disabled class="form-control" name="status" id="setKaryawanStatus" disabled>
                    </div>
                    <!-- Nama Karyawan -->
                    <div class="mb-3">
                        <label for="nama" class="form-label"> Karyawan Yang Tersedia Di Saat Ini</label>
                        <select class=" selectpicker  form-control border
                        <?php echo session('errors.user_id') ? 'is-invalid' : '' ?>" name="user_id" id="karyawan_id"
                            data-live-search="true">
                            <option value="">-- Pilih Karyawan --</option>
                            <?php foreach ($karyawans as $karyawans): ?>
                            <option value="<?php echo $karyawans['id'] ?>"
                                <?php echo old('user_id') == $karyawans['id'] ? 'selected' : '' ?>>
                                <?php echo $karyawans['detail_name'] ?>-<?php echo $karyawans['nohp'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.user_id')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.user_id')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- catatan -->
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control
                            <?php echo session('errors.catatan') ? 'is-invalid' : '' ?>" name="catatan"
                            placeholder="Masukkan catatan "><?php echo old('catatan') ?></textarea>
                        <?php if (session('errors.catatan')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.catatan')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-calendar-check"></i> Jadwalkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end set karyawan modal -->

<form id="deleteForm" method="POST" style="display: none;">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="id" id="deleteId">
</form>
<form id="selesaikanForm" method="POST" style="display: none;">
    <input type="hidden" name="id" id="pemesananId">
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
                $("#deleteForm").attr("action", "/pemesanan/" + id);
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
    $(".btn-selesai").click(function(e) {
        const id = $(this).data('id');
        console.log(id);
        swal({
            title: "Yakin Untuk Menyelesaikan Pesanan ini ?",
            text: "Data Akan Ditandai sebagai pesanan yang selesai, ketik ya jika ingin menyelesaikan pesanan",
            type: "info",
            buttons: {
                cancel: {
                    visible: true,
                    text: "Tidak, Batalkan!",
                    className: "btn btn-danger",
                },
                confirm: {
                    text: "Ya, Selesaikan Sekarang!",
                    className: "btn btn-success",
                },
            },
        }).then((willUpdate) => {
            if (willUpdate) {
                $("#pemesananId").val(id);
                $("#selesaikanForm").attr("action", "/pemesanan-selesai/" + id);
                $("#selesaikanForm").submit();
            } else {
                swal("Batal Melakukan Penyelesaian!", {
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
        const user_id = $(this).data('user_id');
        const paket_id = $(this).data('paket_id');
        const tanggal = $(this).data('tanggal');
        const jam = $(this).data('jam');
        const lokasi = $(this).data('lokasi');
        const status = $(this).data('status');
        $('#id').val(id);
        $('#tanggal').val(tanggal);
        $('#jam').val(jam);
        $('#lokasi').val(lokasi);
        $('#status').val(status);
        $('#update_user_id').val(user_id);
        $('#user_id').selectpicker('val', String(user_id));
        $('#paket_id').selectpicker('val', String(paket_id));
        $('#updateForm').attr('action', '/pemesanan/' + id);
    });


    ////////////////js set karyawan//////////////////////////////////////////////
    $('.open-set-karyawan-modal').on('click', function() {
        const id = $(this).data('id');
        //userid ini untuk set selectbox pelanggan
        const user_id = $(this).data('user_id');
        const paket_id = $(this).data('paket_id');
        const tanggal = $(this).data('tanggal');
        const jam = $(this).data('jam');
        const lokasi = $(this).data('lokasi');
        const status = $(this).data('status');
        $('#pemesanan_id').val(id);
        $('#setKaryawanTanggal').val(tanggal);
        $('#setKaryawanJam').val(jam);
        $('#setKaryawanLokasi').val(lokasi);
        $('#setKaryawanStatus').val(status);
        $('#setKaryawanUser_id').selectpicker('val', String(user_id));
        $('#setKaryawanPaket_id').selectpicker('val', String(paket_id));
        $('#updateFormKaryawan').attr('action', '/jadwal-pemotretan');
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