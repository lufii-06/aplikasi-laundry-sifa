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
    <div class="container-fluid py-0">
        <h5 class="text-center">DITA LAUNDRY</h5>
        <p class="text-center">JLN, MALINTANG NO.68 CUPAK TENGAH, KEC, PAUH <br> KOTA PADANG,SUMATERA BARAT</p>
        <hr>
        <h5 class="text-center">Laporan Transaksi Pertahun</h5>
        <p>Tahun : <?php echo $tahun ?></p>
        <div>
            <table class="table table-bordered table-hover table-striped bg-transparent w-100">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nama_bulan = [
                            1 => 'Januari', 2    => 'Februari', 3 => 'Maret', 4     => 'April',
                            5 => 'Mei', 6        => 'Juni', 7     => 'Juli', 8      => 'Agustus',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                        ];
                        $totalTransaksi = 0;
                    ?>

                    <?php foreach ($datas as $bulan => $total): ?>
                    <?php $totalTransaksi += $total; ?>
                    <tr>
                        <td><?php echo $nama_bulan[$bulan] ?></td>
                        <td><?php echo number_format($total, 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td><strong>Total Transaksi:</strong></td>
                        <td><strong><?php echo number_format($totalTransaksi, 0, ',', '.') ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-end">Padang, <?php echo date('d F Y') ?></p>
        <br>
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