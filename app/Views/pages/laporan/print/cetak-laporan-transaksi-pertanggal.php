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
        <h5 class="text-center">Laporan Transaksi Pertanggal</h5>
        <p>Tanggal : <?php echo $tgl_awal . " s/d " . $tgl_akhir ?></p>
        <div>
            <!-- <table class="table table-bordered table-hover table-striped bg-transparent w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th>Nama Pelanggan</th>
                        <th>total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($datas)): ?>
                    <?php $no = 1;
                    $jmlTotal = 0;foreach ($datas as $d): ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo esc("#" . $d->id) ?></td>
                        <td><?php echo esc($d->nama_pelanggan) ?></td>
                        <td><?php echo esc($d->total) ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Cucian</td>
                        <td>Harga</td>
                        <td>Qty</td>
                        <td>Subtotal</td>
                    </tr>
                    <script>
                        fetch(`/jenis_cucian/${$d->id_cucian}`)
                    </script>
                    <tr>
                    </tr>
                    <?php $jmlTotal += $d->total;endforeach?>
                    <tr>
                        <td colspan="7">Total Seluruhnya</td>
                        <td><?php echo $jmlTotal ?></td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data</td>
                    </tr>
                    <?php endif; ?>
                </tbody>

            </table> -->

            <table class="table table-bordered table-hover table-striped bg-transparent w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th colspan="3">Nama Pelanggan</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php if (!empty($datas)): ?>
                        <?php $no = 1; $jmlTotal = 0; ?>
                        <?php foreach ($datas as $d): ?>
                            <!-- row utama faktur -->
                            <tr class="main-row" data-id-cucian="<?= $d->id_cucian ?>" data-qty="<?= htmlspecialchars($d->qty, ENT_QUOTES, 'UTF-8') ?>">
                                <td><?= $no++ ?></td>
                                <td><?= esc("#".$d->id) ?></td>
                                <td colspan="3"><?= esc($d->nama_pelanggan) ?></td>
                            </tr>

                            <!-- row header jenis cucian -->
                            <tr class="jenis-cucian-header">
                                <td></td>
                                <td>Jenis Cucian</td>
                                <td>Harga</td>
                                <td>Qty</td>
                                <td>Subtotal</td>
                            </tr>

                            <!-- placeholder untuk sub-items -->
                            <tr class="jenis-cucian-row" >
                                <td colspan="5" class="sub-items">Loading...</td>
                            </tr>

                            <?php $jmlTotal += $d->total; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4">Total</td>
                            <td><?= $jmlTotal ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
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

        // ambil row placeholder (setelah header)
        const subRow = row.nextElementSibling.nextElementSibling; 
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
                
                // ganti placeholder dengan baris-baris baru
                data.forEach(item => {
                    const subtotal = (qtyData[item.id_layanan] || 0) * item.harga;

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td></td>
                        <td>${item.nama_cucian}</td>
                        <td>${item.harga}</td>
                        <td>${qtyData[item.id_layanan] || 0}</td>
                        <td>${subtotal}</td>
                    `;

                    // tambahkan sebelum total (atau setelah subRow)
                    subRow.parentNode.insertBefore(tr, subRow);
                });

                // hapus row placeholder "Loading..."
                subRow.remove();
            })
            .catch(err => {
                subItemsTd.textContent = 'Error loading data';
                console.error(err);
        });
    });

});
</script>
    <?php echo $this->include('layouts/js') ?>
</body>

</html>