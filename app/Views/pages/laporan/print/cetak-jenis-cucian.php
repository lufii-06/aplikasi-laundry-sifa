<?php echo $this->include('layouts/heading'); ?>

<body>
    <div class="container py-5">
        <h5 class="text-center">DITA LAUNDRY</h5>
        <p class="text-center">JLN, MALINTANG NO.68 CUPAK TENGAH, KEC, PAUH <br> KOTA PADANG,SUMATERA BARAT</p>
        <hr>
        <h5 class="text-center">Laporan Jenis Cucian</h5>
        <div class="d-flex justify-content-end">
            <table class="table table-bordered table-hover table-striped bg-transparent px-5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Cucian</th>
                        <th>Jenis Layanan</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($datas)): ?>
                    <?php $no = 1;foreach ($datas as $d): ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo esc($d->nama_cucian) ?></td>
                        <td><?php echo esc($d->nama_layanan) ?></td>
                        <td><?php echo esc($d->harga) ?></td>
                        <td><?php echo esc($d->satuan) ?></td>
                    </tr>
                    <?php endforeach?>
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
    <?php echo $this->include('layouts/js') ?>
</body>

</html>