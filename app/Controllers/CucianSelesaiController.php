<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CucianMasuk;
use App\Models\JenisCucian;
use App\Models\Pelanggan;

class CucianSelesaiController extends BaseController
{
    public function index()
    {
        $model            = new CucianMasuk();
        $modelJenisCucian = new JenisCucian();
        $modelPelanggan   = new Pelanggan();
        $pelanggans       = $modelPelanggan->findAll();
        $jenisCucians     = $modelJenisCucian->select('jenis_cucians.*,jenis_layanans.nama_layanan')->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')->findAll();
        $datas            = $model->getWithDetailCucianSelesai();
        return view('pages/cucianSelesai/index.php', [
            "jenisCucians" => $jenisCucians,
            "pelanggans"   => $pelanggans,
            "datas"        => $datas,
        ]);
    }
}