<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisCucian;

class LandingPageController extends BaseController
{
    public function index()
    {
        $model = new JenisCucian();
        $datas = $model->select('jenis_cucians.*,jenis_layanans.nama_layanan')->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')->findAll();
        return view('pages/welcome.php', [
            "datas" => $datas,
        ]);
    }
}