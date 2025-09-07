<?php echo $this->include('layouts/heading'); ?>
<body>
    <div class="container py-5">
        <h5 class="text-center">DITA LAUNDRY</h5>
        <p class="text-center">JLN, MALINTANG NO.68 CUPAK TENGAH, KEC, PAUH <br> KOTA PADANG,SUMATERA BARAT</p>
        <hr>
        <h5 class="text-center">Faktur Cucian</h5>
        <div class="d-flex justify-content-center">
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
                        <td class="label">STATUS</td>
                        <td class="separator">:</td>
                        <td class="value"><?php echo $data->status ?></td>
                    </tr>
                    <tr class="jenis-cucian-container" 
                        data-id-cucian="<?= $data->id_cucian ?>" 
                        data-qty="<?= htmlspecialchars($data->qty, ENT_QUOTES, 'UTF-8') ?>">
                        <td colspan="3">
                            <table class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Jenis Cucian</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="sub-items">
                                    <tr>
                                        <td colspan="4" class="text-center">Loading...</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="label" colspan="3">TOTAL</td>
                                    <td class="value"><?php echo $data->total ?></td>
                                </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                  
                  
                </tbody>
            </table>
        </div>
        <hr>
        <h5 class="text-center">Terima Kasih</h5>
    </div>
    <?php echo $this->include('layouts/js') ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const container = document.querySelector('.jenis-cucian-container');
    if (!container) return;

    const idCucian = container.getAttribute('data-id-cucian');
    const qtyData = JSON.parse(container.getAttribute('data-qty') || '{}');
    for (const id in qtyData) qtyData[id] = Number(qtyData[id]);

    const subItemsTbody = container.querySelector('.sub-items');

    fetch(`/jenis_cucian/${idCucian}`)
        .then(res => res.json())
        .then(data => {
            subItemsTbody.innerHTML = ''; // kosongkan loading

            if (!data.length) {
                subItemsTbody.innerHTML = `<tr><td colspan="4" class="text-center">Tidak ada data</td></tr>`;
                return;
            }

            data.forEach(item => {
                const qty = qtyData[item.id_layanan] || 0;
                const subtotal = qty * item.harga;

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${item.nama_cucian}</td>
                    <td>${item.harga}</td>
                    <td>${qty}</td>
                    <td>${subtotal}</td>
                `;
                subItemsTbody.appendChild(tr);
            });
        })
        .catch(err => {
            subItemsTbody.innerHTML = `<tr><td colspan="4" class="text-danger text-center">Error loading data</td></tr>`;
            console.error(err);
        });
});

    </script>
</body>

</html>