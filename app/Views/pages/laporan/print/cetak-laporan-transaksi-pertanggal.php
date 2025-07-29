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
        <p>Tanggal : <?php echo $tanggal ?></p>
        <div>
            <table class="table table-bordered table-hover table-striped bg-transparent w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Cucian</th>
                        <th>Jenis Layanan</th>
                        <th>Harga</th>
                        <th>qty</th>
                        <th>total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($datas)): ?>
                    <?php $no = 1;
$jmlTotal                     = 0;foreach ($datas as $d): ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo esc("#" . $d->id) ?></td>
                        <td><?php echo esc($d->nama_pelanggan) ?></td>
                        <td><?php echo esc($d->nama_cucian) ?></td>
                        <td><?php echo esc($d->nama_layanan) ?></td>
                        <td><?php echo esc($d->harga) ?></td>
                        <td><?php echo esc($d->qty) ?></td>
                        <td><?php echo esc($d->total) ?></td>
                    </tr>
                    <?php $jmlTotal += $d->total;endforeach?>
                    <tr>
                        <td colspan="7">Total Seluruhnya</td>
                        <td><?php echo $jmlTotal?></td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data</td>
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
    window.onload = function() {
        window.print();
    };
    </script>

    <?php echo $this->include('layouts/js') ?>
</body>

</html>