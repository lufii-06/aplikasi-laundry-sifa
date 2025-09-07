<?php echo $this->include('layouts/heading'); ?>
<style>
@media print {
    body {
        margin: 0;
        padding: 0;
        font-size: 12px;
    }

    table {
        width: 100% !important;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        border: 1px solid #000;
    }

    hr {
        border: 1px solid #000;
    }
}
</style>
<body>
    <div class="container-fluid py-5">
        <h5 class="text-center">DITA LAUNDRY</h5>
        <p class="text-center">JLN, MALINTANG NO.68 CUPAK TENGAH, KEC, PAUH <br> KOTA PADANG,SUMATERA BARAT</p>
        <hr>
        <h5 class="text-center">Cek Status Cucian</h5>
        <div>
            <table class="table table-bordered table-hover table-striped bg-transparent w-100">
                <thead>
                    <tr>
                        <th>No Faktur</th>
                        <th>Nama Pelanggan</th>
                        <th>Nohp</th>
                        <th>Alamat</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Selesai</th>
                        <th>Tanggal Ambil</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($datas)): ?>
                        <?php foreach ($datas as $d): ?>
                            <!-- row utama faktur -->
                            <tr class="main-row" 
                                data-id-cucian="<?= $d->id_cucian ?>" 
                                data-qty="<?= htmlspecialchars($d->qty, ENT_QUOTES, 'UTF-8') ?>">
                                <td><?= esc("#".$d->id) ?></td>
                                <td><?= esc($d->nama_pelanggan) ?></td>
                                <td><?= esc($d->nohp) ?></td>
                                <td><?= esc($d->alamat) ?></td>
                                <td><?= esc($d->tgl_masuk ?? "Belum Ada") ?></td>
                                <td><?= esc($d->tgl_selesai ?? "Belum Ada") ?></td>
                                <td><?= esc($d->tgl_ambil ?? "Belum Ada") ?></td>
                                <td><?= esc($d->status) ?></td>
                            </tr>

                            <!-- row header jenis cucian -->
                            <tr class="jenis-cucian-header">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Jenis Cucian</b></td>
                                <td><b>Harga</b></td>
                                <td><b>Qty</b></td>
                                <td><b>Subtotal</b></td>
                            </tr>

                            <!-- placeholder untuk sub-items -->
                            <tr class="jenis-cucian-row">
                                <td colspan="9" class="sub-items">Loading...</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="3">Total</td>
                                <td><?= $d->total ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <hr>
        <p class="text-end">Padang, <?php echo date('d F Y') ?></p>
        <br><br><br>
        <p class="text-end">Pimpinan</p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.main-row').forEach(row => {
                const idCucian = row.getAttribute('data-id-cucian');
                const qtyData = JSON.parse(row.getAttribute('data-qty') || '{}');
                for (const id in qtyData) qtyData[id] = Number(qtyData[id]);

                const headerRow = row.nextElementSibling;
                const subRow = headerRow.nextElementSibling;
                const subItemsTd = subRow.querySelector('.sub-items');

                fetch(`/jenis_cucian/${idCucian}`)
                    .then(res => res.json())
                    .then(data => {
                        if (!data.length) {
                            subItemsTd.textContent = 'Tidak ada data';
                            return;
                        }

                        // kosongkan placeholder
                        subItemsTd.textContent = '';

                        // tambahkan baris jenis cucian
                        data.forEach(item => {
                            const qty = qtyData[item.id_layanan] || 0;
                            const subtotal = qty * item.harga;

                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>${item.nama_cucian}</td>
                                <td>${item.harga}</td>
                                <td>${qty}</td>
                                <td>${subtotal}</td>
                            `;
                            subRow.parentNode.insertBefore(tr, subRow);
                        });

                        // hapus row placeholder
                        subRow.remove();
                    })
                    .catch(err => {
                        subItemsTd.textContent = 'Error loading data';
                        console.error(err);
                    });
            });

            // auto print
            window.onload = function() {
                window.print();
            };
        });

    </script>

    <?php echo $this->include('layouts/js') ?>
</body>

</html>