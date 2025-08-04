<?php
namespace App\Controllers;

use App\Models\CucianMasuk;
use App\Models\JenisCucian;
use App\Models\Pelanggan;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class CucianMasukController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model            = new CucianMasuk();
        $modelJenisCucian = new JenisCucian();
        $modelPelanggan   = new Pelanggan();
        $pelanggans       = $modelPelanggan->findAll();
        $jenisCucians     = $modelJenisCucian->select('jenis_cucians.*,jenis_layanans.nama_layanan')->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')->findAll();
        $datas            = $model->getWithDetail();
        return view('pages/cucianMasuk/index.php', [
            "jenisCucians" => $jenisCucians,
            "pelanggans"   => $pelanggans,
            "datas"        => $datas,
        ]);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new ()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = Services::validation();
        $rules      = [
            'id_pelanggan' => 'required|numeric',
            'id_cucian'    => 'required',
            'tgl_masuk'    => 'required|valid_date',
            'qty'          => 'required|numeric|min_length[1]',
            'harga'        => 'required|numeric',
            'total'        => 'required|numeric',
            'status'       => 'required|min_length[3]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('error', 'Terjadi Kesalahan Saat Menyimpan Data Cucian Masuk');
        }
        $model = new CucianMasuk();
        $model->insert([
            'id_user'      => session()->get('user')->id ?? 1,
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'id_cucian'    => $this->request->getPost('id_cucian'),
            'tgl_masuk'    => $this->request->getPost('tgl_masuk'),
            'tgl_selesai'  => null,
            'tgl_ambil'    => null,
            'qty'          => $this->request->getPost('qty'),
            'total'        => $this->request->getPost('total'),
            'status'       => $this->request->getPost('status'),
        ]);

        return redirect()->to('/cucian-masuk')->with('success', 'Data Cucian Masuk berhasil ditambahkan.');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {

    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $validation = Services::validation();
        $rules      = [
            'id_pelanggan' => 'required|numeric',
            'id_cucian'    => 'required',
            'tgl_masuk'    => 'required|valid_date',
            'qty'          => 'required|numeric|min_length[1]',
            'harga'        => 'required|numeric',
            'total'        => 'required|numeric',
            'status'       => 'required|min_length[3]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('error', 'Terjadi Kesalahan Saat Mengupdate Data Cucian Masuk');
        }
        $model = new CucianMasuk();
        $model->update($id, [
            'id_user'      => session()->get('user')->id ?? 1,
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'id_cucian'    => $this->request->getPost('id_cucian'),
            'tgl_masuk'    => $this->request->getPost('tgl_masuk'),
            'tgl_selesai'  => null,
            'tgl_ambil'    => null,
            'qty'          => $this->request->getPost('qty'),
            'total'        => $this->request->getPost('total'),
            'status'       => $this->request->getPost('status'),
        ]);

        return redirect()->to('/cucian-masuk')->with('success', 'Data Cucian Masuk berhasil di Edit.');
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $model = new CucianMasuk();
        if ($id === null || ! $model->find($id)) {
            return redirect()->to('/cucian-masuk')->with('error', 'Data tidak ditemukan');
        }
        $model->delete($id);
        return redirect()->to('/cucian-masuk')->with('success', 'Berhasil menghapus Cucian Masuk!');
    }

    public function updateStatusCucian($id = null)
    {
        $validation = Services::validation();
        $model      = new CucianMasuk();
        $rules      = [
            'status' => 'required|min_length[3]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('error', 'Gagal memperbarui status cucian.');
        }

        $status  = $this->request->getPost("status");
        $message = null;
        switch ($status) {
            case 'MASUK': // Admin mulai memproses
                $status  = "DI PROSES";
                $updated = $model->update($id, [
                    'status' => $status,
                ]);
                $message = "Pesanan sudah mulai di proses";
                break;

            case 'DI PROSES': // Admin menyelesaikan
                $status  = "SELESAI";
                $updated = $model->update($id, [
                    'status'      => $status,
                    'tgl_selesai' => date('Y-m-d H:i:s'), // sekarang
                ]);
                $message = "Pesanan sudah ditandai selesai";
                break;

            case 'SELESAI': // Pelanggan mengambil pesanan
                $status  = "SUDAH DI AMBIL";
                $updated = $model->update($id, [
                    'status'    => $status,
                    'tgl_ambil' => date('Y-m-d H:i:s'), // sekarang
                ]);
                $message = "Pesanan sudah diserahkan ke pelanggan";
                break;

            default:
                $status  = 'MASUK';
                $updated = $model->update($id, [
                    'status' => $status,
                ]);
                break;
        }

        if (! $updated) {
            return redirect()->back()
                ->with('error', 'Update gagal, data tidak ditemukan atau terjadi error.');
        }

        return redirect()->to('/cucian-masuk')
            ->with('success', $message);
    }

    public function laporanTransaksiPertanggal()
    {
        return view('pages/laporan/parameter/laporan-transaksi-pertanggal.php');
    }
    public function laporanTransaksiPerbulan()
    {
        return view('pages/laporan/parameter/laporan-transaksi-perbulan.php');
    }
    public function laporanTransaksiPertahun()
    {
        return view('pages/laporan/parameter/laporan-transaksi-pertahun.php');
    }

    public function cetakLaporanFakturTransaksi(string $id)
    {
        $model = new CucianMasuk();
        $data  = $model->getTransaksifaktur($id);
        return view('pages/laporan/print/faktur-transaksi.php', [
            "data" => $data,
        ]);
    }

    public function cetakLaporanPerId()
    {
        $model = new CucianMasuk();
        $id    = $this->request->getPost('id');
        $nohp  = $this->request->getPost('nohp');
        $datas = $model->getTransaksiPerid($id, $nohp);
        if (! $datas) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Data Transaksi dengan id dan nohp tidak sama, atau tidak ditemukan');
        }
        return view('pages/laporan/print/cetak-laporan-transaksi-perid.php', [
            "datas" => $datas,
        ]);
    }

    public function cetakLaporanPertanggal()
    {
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $model     = new CucianMasuk();
        $datas     = $model->getTransaksiPertanggal($tgl_awal, $tgl_akhir);
        return view('pages/laporan/print/cetak-laporan-transaksi-pertanggal.php', [
            "datas"     => $datas,
            "tgl_awal"  => $tgl_awal,
            "tgl_akhir" => $tgl_akhir,
        ]);
    }
    public function cetakLaporanPerbulan()
    {
        $bulan = $this->request->getPost('bulan');
        $model = new CucianMasuk();
        $datas = $model->getTransaksiPerbulan($bulan);
        return view('pages/laporan/print/cetak-laporan-transaksi-perbulan.php', ["datas" => $datas, "bulan" => $bulan]);
    }
    public function cetakLaporanPertahun()
    {
        $tahun = $this->request->getPost('tahun');
        $model = new CucianMasuk();

        // Ambil hasil dari model
        $hasil = $model->getTransaksiPertahun($tahun);

        // Inisialisasi semua bulan 1–12 dengan nilai transaksi 0
        $datas = [];
        for ($i = 1; $i <= 12; $i++) {
            $datas[$i] = 0;
        }

        // Isi berdasarkan hasil query
        foreach ($hasil as $row) {
            $bulan         = (int) $row->bulan;
            $total         = (int) $row->total_per_bulan;
            $datas[$bulan] = $total;
        }

        return view('pages/laporan/print/cetak-laporan-transaksi-pertahun.php', [
            'datas' => $datas,
            'tahun' => $tahun,
        ]);
    }
    public function laporanTransaksiCucianMasuk()
    {
        $model = new JenisCucian();
        $datas = $model->select('satuan')->distinct()->findAll();
        return view('pages/laporan/parameter/laporan-transaksi-cucian-masuk.php', [
            "datas" => $datas,
        ]);
    }
    public function cetakLaporanTransaksiCucianMasuk()
    {
        $model  = new CucianMasuk();
        $satuan = $this->request->getPost('satuan');
        $datas  = $model->getTransaksifakturperSatuan($satuan);
        return view('pages/laporan/print/cetak-laporan-transaksi-cucian-masuk.php', [
            "datas"  => $datas,
            "satuan" => $satuan,
        ]);
    }
}