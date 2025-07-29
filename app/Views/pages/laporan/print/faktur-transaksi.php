<?php echo $this->include('layouts/heading'); ?>

<body>
    <div class="container py-5">
        <h5 class="text-center">DITA LAUNDRY</h5>
        <p class="text-center">JLN, MALINTANG NO.68 CUPAK TENGAH, KEC, PAUH <br> KOTA PADANG,SUMATERA BARAT</p>
        <hr>
        <h5 class="text-center">Faktur Cucian</h5>
        <div class="d-flex justify-content-end">
            <table class=" w-75 px-5">
                <tbody>
                    <tr>
                        <td class="label">No Faktur</td>
                        <td class="separator">:</td>
                        <td class="value">#<?php echo $data->id ?></td>
                    </tr>
                    <tr>
                        <td class="label">NAMA PELANGGAN</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->nama_pelanggan ?></td>
                    </tr>
                    <tr>
                        <td class="label">TANGGAL MASUK</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->tgl_masuk ?></td>
                    </tr>
                    <tr>
                        <td class="label">TANGGAL SELESAI</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->tgl_selesai ?></td>
                    </tr>
                    <tr>
                        <td class="label">JENIS CUCIAN</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->nama_cucian ?></td>
                    </tr>
                    <tr>
                        <td class="label">SATUAN</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->satuan ?></td>
                    </tr>

                    <tr>
                        <td class="label">HARGA</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->harga ?></td>
                    </tr>
                    <tr>
                        <td class="label">QTY</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->qty ?></td>
                    </tr>
                    <tr>
                        <td class="label">TOTAL</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->total ?></td>
                    </tr>
                    <tr>
                        <td class="label">STATUS</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->status ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <h5 class="text-center">Terima Kasih</h5>
    </div>
    <?php echo $this->include('layouts/js') ?>
</body>

</html>