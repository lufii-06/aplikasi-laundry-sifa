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
            <a href="/pelanggan">Pelanggan</a>
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
                    <h4 class="card-title">Data Pelanggan</h4>
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Tambah
                        Data</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID Pelanggan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nohp</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($datas as $data): ?>
                                <tr>
                                    <td><?php echo "#" . $data->id ?></td>
                                    <td><?php echo $data->nama ?></td>
                                    <td><?php echo $data->jenis_kelamin ?></td>
                                    <td><?php echo $data->nohp ?></td>
                                    <td><?php echo $data->alamat ?></td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-bs-target="#updateModal" data-bs-toggle="modal"
                                                class="btn btn-link btn-primary btn-lg open-edit-modal"
                                                data-id="<?php echo $data->id ?>" data-nama="<?php echo $data->nama ?>"
                                                data-jenis_kelamin="<?php echo $data->jenis_kelamin ?>"
                                                data-nohp="<?php echo $data->nohp ?>"
                                                data-alamat="<?php echo $data->alamat ?>"
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
                <form action="<?php echo base_url('/pelanggan') ?>" method="post">
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control
                            <?php echo session('errors.nama') ? 'is-invalid' : '' ?>" name="nama"
                            placeholder="Masukkan Nama" value="<?php echo old('nama') ?>">
                        <?php if (session('errors.nama')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.nama')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control
                            <?php echo session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>" name="jenis_kelamin">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki"
                                <?php echo old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan"
                                <?php echo old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <?php if (session('errors.jenis_kelamin')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.jenis_kelamin')) ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- No HP -->
                    <div class="mb-3">
                        <label for="nohp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control
                            <?php echo session('errors.nohp') ? 'is-invalid' : '' ?>" name="nohp"
                            placeholder="Contoh: 081234567890" value="<?php echo old('nohp') ?>">
                        <?php if (session('errors.nohp')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.nohp')) ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control
                             <?php echo session('errors.alamat') ? 'is-invalid' : '' ?>" name="alamat"
                            placeholder="Masukkan alamat lengkap" value="<?php echo old('alamat') ?>">
                        <?php if (session('errors.alamat')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.alamat')) ?>
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
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control
                            <?php echo session('errors.nama') ? 'is-invalid' : '' ?>" name="nama" id="nama"
                            placeholder="Masukkan Nama" value="<?php echo old('nama') ?>">
                        <?php if (session('errors.nama')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.nama')) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control
                            <?php echo session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>" name="jenis_kelamin"
                            id="jenis_kelamin">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki"
                                <?php echo old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan"
                                <?php echo old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <?php if (session('errors.jenis_kelamin')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.jenis_kelamin')) ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- No HP -->
                    <div class="mb-3">
                        <label for="nohp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control
                            <?php echo session('errors.nohp') ? 'is-invalid' : '' ?>" name="nohp" id="nohp"
                            placeholder="Contoh: 081234567890" value="<?php echo old('nohp') ?>">
                        <?php if (session('errors.nohp')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.nohp')) ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control
                             <?php echo session('errors.alamat') ? 'is-invalid' : '' ?>" name="alamat" id="alamat"
                            placeholder="Masukkan alamat lengkap" value="<?php echo old('alamat') ?>">
                        <?php if (session('errors.alamat')): ?>
                        <div class="invalid-feedback">
                            <?php echo esc(session('errors.alamat')) ?>
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

<script src="<?php echo base_url() ?>assets/js/core/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
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
                $("#deleteForm").attr("action", "/pelanggan/" + id);
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
        const nama = $(this).data('nama');
        const jenis_kelamin = $(this).data('jenis_kelamin');
        const nohp = $(this).data('nohp');
        const alamat = $(this).data('alamat');
        console.log(id, nama, jenis_kelamin, nohp, alamat);
        $('#nama').val(nama);
        $('#jenis_kelamin').val(jenis_kelamin).trigger('change');
        $('#nohp').val(nohp);
        $('#alamat').val(alamat);
        $('#updateForm').attr('action', '/pelanggan/' + id);
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