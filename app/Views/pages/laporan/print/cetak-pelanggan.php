<?php echo $this->include('layouts/heading'); ?>

<body>
    <div class="container py-5">
        <h5 class="text-center">DITA LAUNDRY</h5>
        <p class="text-center">JLN, MALINTANG NO.68 CUPAK TENGAH, KEC, PAUH <br> KOTA PADANG,SUMATERA BARAT</p>
        <hr>
        <h5 class="text-center">Laporan Data Pelanggan</h5>
        <div class="d-flex justify-content-end">
            <table class="table table-bordered table-hover table-striped bg-transparent px-5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Kelamin</th>
                        <th>Nohp</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($datas)): ?>
                    <?php $no = 1;foreach ($datas as $d): ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo esc($d->nama) ?></td>
                        <td><?php echo esc($d->jenis_kelamin) ?></td>
                        <td><?php echo esc($d->nohp) ?></td>
                        <td><?php echo esc($d->alamat) ?></td>
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