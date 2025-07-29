<?php
namespace App\Controllers;

use App\Models\JenisCucian;
use App\Models\JenisLayanan;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class JenisCucianController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model         = new JenisCucian();
        $modelLayanan  = new JenisLayanan();
        $datas         = $model->select('jenis_cucians.*,jenis_layanans.nama_layanan')->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')->findAll();
        $jenisLayanans = $modelLayanan->findAll();
        return view('pages/jenisCucian/index.php', [
            "datas"         => $datas,
            "jenisLayanans" => $jenisLayanans,
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
            'nama_cucian' => 'required|min_length[3]',
            'id_layanan'  => 'required',
            'harga'       => 'required|numeric|min_length[3]',
            'satuan'      => 'required|min_length[1]|max_length[10]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('error', 'Terjadi Kesalahan Saat Menyimpan Data jenis cucian');
        }

        $model = new JenisCucian();
        $model->insert([
            'nama_cucian' => $this->request->getPost('nama_cucian'),
            'id_layanan'  => $this->request->getPost('id_layanan'),
            'harga'       => $this->request->getPost('harga'),
            'satuan'      => $this->request->getPost('satuan'),
        ]);

        return redirect()->to('/jenis-cucian')->with('success', 'Data Jenis Cucian berhasil ditambahkan.');
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
        //
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

        $rules = [
            'nama_cucian' => 'required|min_length[3]',
            'id_layanan'  => 'required',
            'harga'       => 'required|numeric|min_length[3]',
            'satuan'      => 'required|min_length[1]|max_length[10]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('error', 'Terjadi Kesalahan Saat Menyimpan Data jenis cucian');
        }

        $model = new JenisCucian();
        $model->update($id, [
            'nama_cucian' => $this->request->getPost('nama_cucian'),
            'harga'       => $this->request->getPost('harga'),
            'satuan'      => $this->request->getPost('satuan'),
        ]);
        return redirect()->to('/jenis-cucian')->with('success', 'Data Jenis Cucian berhasil diubah.');
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
        $model = new JenisCucian();
        if ($id === null || ! $model->find($id)) {
            return redirect()->to('/jenis-cucian')->with('error', 'Data tidak ditemukan');
        }
        $model->delete($id);
        return redirect()->to('/jenis-cucian')->with('success', 'Berhasil menghapus Jenis Cucian!');
    }

    public function laporan()
    {
        $model = new JenisCucian();
        $data  = count($model->findAll());
        return view('pages/laporan/parameter/jenis-cucian.php', ["data" => $data]);
    }

    public function cetakLaporan()
    {
        $Model          = new JenisCucian();
        $jmljenisCucian = $this->request->getPost('jenisCucian');
        $jmljenisCucian = (int) $jmljenisCucian;
        $datas          = $Model->select('jenis_cucians.*,jenis_layanans.nama_layanan')->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')
            ->limit($jmljenisCucian)->findAll();
        return view('pages/laporan/print/cetak-jenis-cucian.php', ["datas" => $datas]);
    }
}