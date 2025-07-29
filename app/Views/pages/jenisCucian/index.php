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
            <a href="/jenis-cucian">Jenis Cucian</a>
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
                    <h4 class="card-title">Data Jenis Cucian</h4>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Tambah
                        Data</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID Jenis Cucian</th>
                                    <th>Nama Jenis</th>
                                    <th>Nama Layanan</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($datas as $data): ?>
                                <tr>
                                    <td><?php echo "#" . $data->id ?></td>
                                    <td><?php echo $data->nama_cucian ?></td>
                                    <td><?php echo $data->nama_layanan ?></td>
                                    <td><?php echo $data->harga ?></td>
                                    <td><?php echo $data->satuan ?></td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-bs-target="#updateModal" data-bs-toggle="modal"
                                                class="btn btn-link btn-primary btn-lg open-edit-modal"
                                                data-id="<?php echo $data->id ?>"
                                                data-nama_cucian="<?php echo $data->nama_cucian ?>"
                                                data-id_layanan="<?php echo $data->id_layanan ?>"
                                                data-harga="<?php echo $data->harga ?>"
                                                data-satuan="<?php echo $data->satuan ?>"
                                                data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                data-id="<?php echo $data->id ?>"
                                                class="btn btn-link btn-danger alert-delete"
                                                data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('/jenis-cucian') ?>" method="post">
                    <!-- Nama Cucian -->
                    <div class="mb-3">
                        <label for="nama_cucian" class="form-label">Nama Cucian</label>
                        <input type="text" class="form-control
                            <?php echo session('errors.nama_cucian') ? 'is-invalid' : '' ?>" name="nama_cucian"
                            placeholder="Masukkan Nama Cucian" value="<?php echo old('nama_cucian') ?>">
                        <?php if (session('errors.nama_cucian')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.nama_cucian')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Jenis Layanan -->
                    <div class="mb-3">
                        <label for="id_layanan" class="form-label ">Jenis Layanan</label>
                        <select class=" selectpicker  form-control border
                        <?php echo session('errors.id_layanan') ? 'is-invalid' : '' ?>" name="id_layanan"
                            data-live-search="true">
                            <option value="">-- Pilih Jenis Cucian --</option>
                            <?php foreach ($jenisLayanans as $jenisLayanan): ?>
                            <option value="<?php echo $jenisLayanan->id ?>">
                                <?php echo $jenisLayanan->nama_layanan ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.id_layanan')): ?>
                        <div class="invalid-feedback d-block">
                            <?php echo esc(session('errors.id_layanan')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control
                            <?php echo session('errors.harga') ? 'is-invalid' : '' ?>" name="harga"
                            placeholder="Masukkan Harga" value="<?php echo old('harga') ?>">
                        <?php if (session('errors.harga')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.harga')) ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Satuan -->
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control
                             <?php echo session('errors.satuan') ? 'is-invalid' : '' ?>" name="satuan"
                            placeholder="Masukkan satuan" value="<?php echo old('satuan') ?>">
                        <?php if (session('errors.satuan')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.satuan')) ?>
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
                <form id="updateForm" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    <!-- Nama Cucian -->
                    <div class="mb-3">
                        <label for="nama_cucian" class="form-label">Nama Cucian</label>
                        <input type="text" class="form-control
                            <?php echo session('errors.nama_cucian') ? 'is-invalid' : '' ?>" name="nama_cucian"
                            id="nama_cucian" placeholder="Masukkan Nama Cucian"
                            value="<?php echo old('nama_cucian') ?>">
                        <?php if (session('errors.nama_cucian')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.nama_cucian')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Jenis Layanan -->
                    <div class="mb-3">
                        <label for="id_layanan" class="form-label">Jenis Layanan</label>
                        <select class=" selectpicker  form-control border " name="id_layanan" id="id_layanan"
                            data-live-search="true">
                            <option value="">-- Pilih Jenis Cucian --</option>
                            <?php foreach ($jenisLayanans as $jenisLayanan): ?>
                            <option value="<?php echo $jenisLayanan->id ?>">
                                <?php echo $jenisLayanan->nama_layanan ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control
                            <?php echo session('errors.harga') ? 'is-invalid' : '' ?>" name="harga" id="harga"
                            placeholder="Masukkan Harga" value="<?php echo old('harga') ?>">
                        <?php if (session('errors.harga')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.harga')) ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Satuan -->
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control
                             <?php echo session('errors.satuan') ? 'is-invalid' : '' ?>" name="satuan" id="satuan"
                            placeholder="Masukkan satuan" value="<?php echo old('satuan') ?>">
                        <?php if (session('errors.satuan')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.satuan')) ?>
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
<!-- end update modal -->

<form id="deleteForm" method="POST" style="display: none;">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="id" id="deleteId">
</form>

<script src="<?php echo base_url() ?>/assets/js/core/jquery-3.7.1.min.js"></script>
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
                $("#deleteForm").attr("action", "/jenis-cucian/" + id);
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

    //js update data ke modal
    $('.open-edit-modal').on('click', function() {
        const id = $(this).data('id');
        const nama_cucian = $(this).data('nama_cucian');
        const id_layanan = $(this).data('id_layanan');
        const harga = $(this).data('harga');
        const satuan = $(this).data('satuan');
        $('#nama_cucian').val(nama_cucian);
        $('#id_layanan').selectpicker('val', String(id_layanan));
        $('#harga').val(harga);
        $('#satuan').val(satuan);
        $('#updateForm').attr('action', '/jenis-cucian/' + id);
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