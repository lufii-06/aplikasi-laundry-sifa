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


 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
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
                                                data-qty="<?= htmlspecialchars($data->qty, ENT_QUOTES, 'UTF-8') ?>"
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
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('/cucian-masuk') ?>" method="post">
                    <div class="row">
                        <div class="col-6">
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
                        </div>
                        <div class="col-6">
                            <!-- Nama Pelanggan -->
                            <div class="mb-3 ">
                                <label for="id_pelanggan" class="form-label">Nama Pelanggan</label>
                                <select data-width="100%" class=" selectpicker  form-control border
                                <?php echo session('errors.id_pelanggan') ? 'is-invalid' : '' ?>" name="id_pelanggan"
                                    id="id_pelanggan" data-live-search="true"  >
                                    <option value="">-- Pilih Pelanggan --</option>
                                    <?php foreach ($pelanggans as $pelanggan): ?>
                                    <option value="<?= $pelanggan->id ?>"
                                            data-subtext="<?= $pelanggan->jenis_kelamin ?> | <?= $pelanggan->nohp ?> | <?= $pelanggan->alamat ?>">
                                        <?= $pelanggan->nama ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errors.id_pelanggan')): ?>
                                <div class="invalid-feedback d-block">
                                    <?php echo esc(session('errors.id_pelanggan')) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
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
                        </div>
                        <div class="col-6">
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
                        <div class="col-12">
                             <!-- Status -->
                            <div class="mb-3">
                                <label for="tags" class="form-label">Jenis Cucian</label>
                                <div class="d-flex gap-2 align-items-center">
                                    <input id="tags" class="form-control" placeholder="Ketik lalu Enter">
                                    <button type="button" class="btn btn-info btn-sm" style="white-space: nowrap;" id="buatPesanan">Buat Pesanan</button>
                                    <button type="button" class="btn btn-danger btn-sm" style="white-space: nowrap;" id="resetPesanan"><i class="fa fa-sync text-white"></i>&nbsp;</button>
                                </div>
                                <!-- hidden input untuk kirim data ke backend -->
                                <input type="hidden" name="id_cucian" id="id_cucian">
                            </div>
                            <div id="form-container"></div>
                            <!-- dibawah ini adalah isi dari form container -->
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
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Update Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-6">
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
                        </div>
                        <div class="col-6">
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
                        </div>
                        <div class="col-6">
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
                        </div>
                        <div class="col-6">
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
                        </div>
                        <div class="col-12">
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
                        <div class="col-12">
                             <!-- Status -->
                            <div class="mb-3">
                                <label for="tagsUpdate" class="form-label">Jenis Cucian</label>
                                <div class="d-flex gap-2 align-items-center">
                                    <input id="tagsUpdate" class="form-control" placeholder="Ketik lalu Enter">
                                    <button type="button" class="btn btn-info btn-sm" style="white-space: nowrap;" id="buatPesananUpdate">Buat Pesanan</button>
                                    <button type="button" class="btn btn-danger btn-sm" style="white-space: nowrap;" id="resetPesananUpdate"><i class="fa fa-sync text-white"></i>&nbsp;</button>
                                </div>
                                <!-- hidden input untuk kirim data ke backend -->
                                <input type="hidden" name="id_cucianUpdate" id="id_cucianUpdate">
                            </div>
                            <div id="form-container-update"></div>
                            <!-- dibawah ini adalah isi dari form container -->
                        </div>
                    </div>
                    <!-- Total -->
                    <div class="mb-3">
                        <label for="insertTotalUpdate" class="form-label">Total</label>
                        <input type="text" readonly class="form-control
                             <?php echo session('errors.total') ? 'is-invalid' : '' ?>" name="total" id="insertTotalUpdate"
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

<!-- inisiasi tagify dari $jenislayanan -->
<?php
$whiteList = [];
foreach ($jenisCucians as $value) {
    $whiteList[] = [
        "value" => $value->id,              // ini yg dikirim ke backend
        "name"  => $value->nama_cucian     // ini yg ditampilkan di UI
    ];
}
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js" defer></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js" defer></script>
 <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>


<script>
$(document).ready(function() {

    ///tagify code untuk insert
    let tagify = new Tagify(document.querySelector("#tags"), {
        enforceWhitelist: true,
        duplicates: false,
        tagTextProp: "name",
        dropdown: {
            enabled: 0,
            closeOnSelect: true,
            maxItems: 20,
            mapValueTo: "name",
            searchKeys: ["name"]
        },
        whitelist: <?php echo json_encode($whiteList); ?>
    });
    tagify.on("add", e => {
        const added = e.detail.data;
        if (!added.value || isNaN(added.value)) {
            // kalau value kosong / bukan id valid, hapus tag
            tagify.removeTags(added.value || added.name);
        }
    });

    // setiap ada perubahan, update hidden input
    tagify.on("change", () => {
        const ids = tagify.value
            .filter(t => t.value)       // hanya ambil yang ada value
            .map(t => t.value);         // ambil id (bukan name)
        // simpan ke hidden input
        const hiddenInput = document.querySelector("#id_cucian");
        console.log(hiddenInput);
        hiddenInput.value = ids.join("-");
    });
    ///end tagify code

    ///tagify code untuk update
    let tagifyUpdate = new Tagify(document.querySelector("#tagsUpdate"), {
        enforceWhitelist: true,
        duplicates: false,
        tagTextProp: "name",
        dropdown: {
            enabled: 0,
            closeOnSelect: true,
            maxItems: 20,
            mapValueTo: "name",
            searchKeys: ["name"]
        },
        whitelist: <?php echo json_encode($whiteList); ?>
    });
    tagifyUpdate.on("add", e => {
        const added = e.detail.data;
        if (!added.value || isNaN(added.value)) {
            // kalau value kosong / bukan id valid, hapus tag
            tagifyUpdate.removeTags(added.value || added.name);
        }
    });

    // setiap ada perubahan, update hidden input
    tagifyUpdate.on("change", () => {
        const ids = tagifyUpdate.value
            .filter(t => t.value)       // hanya ambil yang ada value
            .map(t => t.value);         // ambil id (bukan name)
        // simpan ke hidden input
        const hiddenInput = document.querySelector("#id_cucianUpdate");
        console.log(hiddenInput);
        hiddenInput.value = ids.join("-");
    });
    ///end tagifyUpdate code

    ///start insert render
    function render(){
         const hiddenInput = document.querySelector("#id_cucian");
        // hentikan kalau kosong
        if (!hiddenInput.value) {
            alert("Pilih jenis cucian dahulu");
            return;
        }

        // fetch ke route sesuai CI4 kamu
        fetch(`/jenis_cucian/${hiddenInput.value}`)
        .then(res => res.json())
        .then(data => {
            const formContainer = document.querySelector("#form-container");
            formContainer.innerHTML = "";

        data.forEach((item, index) => {
            formContainer.innerHTML += `
                <div class="row mb-3 border p-2 rounded">
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Nama Layanan -->
                        <div class="mb-3">
                            <label class="form-label">Nama Layanan</label>
                            <input type="text" readonly class="form-control"
                                
                                value="${item.nama_layanan}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Satuan -->
                        <div class="mb-3">
                            <label class="form-label">Satuan</label>
                            <input type="text" readonly class="form-control"
                                value="${item.satuan}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Qty -->
                        <div class="mb-3">
                            <label class="form-label">Qty</label>
                            <input type="number" class="form-control qty-input"
                                name="qty[]" min="1" value="1"
                                data-index="${index}" data-harga="${item.harga}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Harga -->
                        <div class="mb-3">
                            <label class="form-label">Harga Per Satuan</label>
                            <input type="text" readonly class="form-control"
                                value="${item.harga}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Subtotal -->
                        <div class="mb-3">
                            <label class="form-label">Subtotal</label>
                            <input type="text" readonly class="form-control subtotal-input"
                                 id="subtotal-${index}" value="${item.harga}">
                        </div>
                    </div>
                </div>
            `;
        });

        // tambahkan listener untuk hitung subtotal
        document.querySelectorAll(".qty-input").forEach(input => {
            input.addEventListener("input", function () {
                const harga = parseFloat(this.dataset.harga);
                const qty = parseInt(this.value) || 0;
                const subtotal = harga * qty;
                const index = this.dataset.index;
                document.getElementById(`subtotal-${index}`).value = subtotal;
                hitungTotal();
            });
        });
          // hitung total pertama kali
            hitungTotal();
        })
        .catch(err => console.error("Fetch error:", err));
    }
    /// end update render

    ///start update render
    function renderUpdate(qty = []){
         const hiddenInput = document.querySelector("#id_cucianUpdate");
        // hentikan kalau kosong
        if (!hiddenInput.value) {
            alert("Pilih jenis cucian dahulu");
            return;
        }
        // fetch ke route sesuai CI4 kamu
        fetch(`/jenis_cucian/${hiddenInput.value}`)
        .then(res => res.json())
        .then(data => {
            const formContainer = document.querySelector("#form-container-update");
            formContainer.innerHTML = "";
        data.forEach((item, index) => {
            console.log(item);
            const itemQty = qty.find(q => q.id == item.id)?.qty || "";
            if(itemQty !== ""){
                tagifyUpdate.addTags([{ value: item.id, name: item.nama_cucian }]);
            }
            formContainer.innerHTML += `
                <div class="row mb-3 border p-2 rounded">
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Nama Layanan -->
                        <div class="mb-3">
                            <label class="form-label">Nama Layanan</label>
                            <input type="text" readonly class="form-control"
                                
                                value="${item.nama_layanan}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Satuan -->
                        <div class="mb-3">
                            <label class="form-label">Satuan</label>
                            <input type="text" readonly class="form-control"
                                value="${item.satuan}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Qty -->
                        <div class="mb-3">
                            <label class="form-label">Qty</label>
                            <input type="number" class="form-control qty-input-update" required
                                name="qty[]" min="1" value="${itemQty}"
                                data-index="${index}" data-harga="${item.harga}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Harga -->
                        <div class="mb-3">
                            <label class="form-label">Harga Per Satuan</label>
                            <input type="text" readonly class="form-control"
                                value="${item.harga}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <!-- Subtotal -->
                        <div class="mb-3">
                            <label class="form-label">Subtotal</label>
                            <input type="text" readonly class="form-control subtotal-input-update"
                                 id="subtotal-${index}" value="${item.harga}">
                        </div>
                    </div>
                </div>
            `;
        });

        // tambahkan listener untuk hitung subtotal
        document.querySelectorAll(".qty-input-update").forEach(input => {
            input.addEventListener("input", function () {
                const harga = parseFloat(this.dataset.harga);
                const qty = parseInt(this.value) || 0;
                const subtotal = harga * qty;
                const index = this.dataset.index;
                document.getElementById(`subtotal-${index}`).value = subtotal;
                hitungTotalUpdate();
            });
        });
          // hitung total pertama kali
            hitungTotalUpdate();
        })
        .catch(err => console.error("Fetch error:", err));
    }
    /// end update render

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll(".subtotal-input").forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById("insertTotal").value = total;
    }
    function hitungTotalUpdate() {
        let total = 0;
        document.querySelectorAll(".subtotal-input-update").forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById("insertTotalUpdate").value = total;
    }

    $(function() {
        $('select').selectpicker();
    });
        //ini code lama dimana 1 transaksi hanya  boleh satu layanan
    // $("#insertJenisCucian").change(function() {
    //     const selected = $(this).find(":selected");
    //     const satuan = selected.data('satuan');
    //     const nama_layanan = selected.data('nama_layanan');
    //     const harga = selected.data('harga');
    //     $("#insertNamaLayanan").val(nama_layanan);
    //     $("#insertSatuan").val(satuan);
    //     $("#insertHarga").val(harga);
    //     //hitung total
    //     const qty = $('#insertQty').val();
    //     console.log(qty, harga)
    //     $("#insertTotal").val(qty * harga);
    // });

    // $("#insertQty").change(function() {
    //     const qty = $(this).val();
    //     const harga = $("#insertHarga").val();
    //     $("#insertTotal").val(qty * harga);
    // });

    // $("#updateJenisCucian").change(function() {
    //     const selected = $(this).find(":selected");
    //     const satuan = selected.data('satuan');
    //     const nama_layanan = selected.data('nama_layanan');
    //     const harga = selected.data('harga');
    //     $("#updateNamaLayanan").val(nama_layanan);
    //     $("#updateSatuan").val(satuan);
    //     $("#updateHarga").val(harga);
    //     //hitung total
    //     const qty = $('#updateQty').val();
    //     $("#updateTotal").val(qty * harga);

    // });

    // $("#updateQty").change(function() {
    //     const qty = $(this).val();
    //     const harga = $("#updateHarga").val();
    //     $("#updateTotal").val(qty * harga);
    // });

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
        const qtyStr = $(this).attr('data-qty');
        const total = $(this).data('total');
        $('#updateTgl_masuk').val(tglMasuk);
        $('#updateTgl_selesai').val(tglSelesai);
        $('#updateTgl_ambil').val(tglAmbil);
        $('#updateStatus').val(status);
        $('#id_cucianUpdate').val(idCucian);
        // $('#updateJenisCucian').selectpicker('val', String(idCucian));
        $('#updateIdPelanggan').selectpicker('val', String(idPelanggan));
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
        const qty = Object.entries(JSON.parse(qtyStr))
            .map(([id, qty]) => ({ id, qty }));
        renderUpdate(qty);
    });
    $('#updateModal').on('hidden.bs.modal', function() {
        // Reset semua input
        $(this).find('form')[0].reset();

        // Hapus error class dan pesan validasi
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
    });

    // togle aktif dan non aktif reset dan buat pesanan
    let $btnBuat = $("#buatPesanan");
    let $btnReset = $("#resetPesanan");
    let $formContainer = $("#form-container");

    // state awal
    $btnReset.prop("disabled", true);

    // klik Buat Pesanan
    $btnBuat.on("click", function () {
         const hiddenInput = document.querySelector("#id_cucian");

         if (!hiddenInput.value) {
            alert("Pilih Jenis cucian dahulu");
            return;
        }
        render(); // panggil fungsi render

        $btnBuat.prop("disabled", true);   // disable Buat
        $btnReset.prop("disabled", false); // enable Reset
    });

    // klik Reset
    $btnReset.on("click", function () {
        $formContainer.empty(); // kosongkan container
        $("#insertTotal").val(""); // kosongkan total
        $("#id_cucian").val(""); // kosongkan hidden input
        tagify.removeAllTags();
        $btnBuat.prop("disabled", false);  // enable Buat
        $btnReset.prop("disabled", true);  // disable Reset
    });

    /// togle aktif dan non aktif reset dan buat pesanan update
    let $btnBuatUpdate = $("#buatPesananUpdate");
    let $btnResetUpdate = $("#resetPesananUpdate");
    let $formContainerUpdate = $("#form-container-update");

    // state awal
    $btnBuatUpdate.prop("disabled", true);

    // klik Buat Pesanan
    $btnBuatUpdate.on("click", function () {
        const hiddenInputUpdate = document.querySelector("#id_cucianUpdate");

         if (!hiddenInputUpdate.value) {
            alert("Pilih Jenis cucian dahulu");
            return;
        }
        renderUpdate(); // panggil fungsi render

        $btnBuatUpdate.prop("disabled", true);   // disable Buat
        $btnResetUpdate.prop("disabled", false); // enable Reset
    });

    // klik Reset
    $btnResetUpdate.on("click", function () {
        $formContainerUpdate.empty(); // kosongkan container
        $("#insertTotalUpdate").val(""); // kosongkan total
        $("#id_cucianUpdate").val(""); // kosongkan hidden input
        tagifyUpdate.removeAllTags();
        $btnBuatUpdate.prop("disabled", false);  // enable Buat
        $btnResetUpdate.prop("disabled", true);  // disable Reset
    });
});
</script>

<?php echo $this->endSection('content') ?>