<?php
namespace App\Controllers;

use App\Models\JenisLayanan;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class JenisLayananController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new JenisLayanan();
        $datas = $model->findAll();
        return view('pages/jenisLayanan/index.php', ["datas" => $datas]);
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

        $rules = [
            'nama_layanan' => 'required|min_length[3]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('error', 'Terjadi Kesalahan Saat Menyimpan Data jenis Layanan');
        }

        $model = new JenisLayanan();
        $model->insert([
            'nama_layanan' => $this->request->getPost('nama_layanan'),
        ]);

        return redirect()->to('/jenis-layanan')->with('success', 'Data Jenis Layanan berhasil ditambahkan.');
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
            'nama_layanan' => 'required|min_length[3]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('error', 'Terjadi Kesalahan Saat Menyimpan Data jenis Layanan');
        }

        $model = new JenisLayanan();
        $model->update($id, [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
        ]);

        return redirect()->to('/jenis-layanan')->with('success', 'Data Jenis Layanan berhasil diubah.');
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
        $model = new JenisLayanan();
        if ($id === null || ! $model->find($id)) {
            return redirect()->to('/jenis-layanan')->with('error', 'Data tidak ditemukan');
        }
        $model->delete($id);
        return redirect()->to('/jenis-layanan')->with('success', 'Berhasil menghapus Jenis Layanan!');
    }

    public function laporan()
    {
        $model = new JenisLayanan();
        $data  = count($model->findAll());
        return view('pages/laporan/parameter/jenis-layanan.php', ["data" => $data]);
    }

    public function cetakLaporan()
    {
        $Model           = new JenisLayanan();
        $jmljenisLayanan = $this->request->getPost('jenisLayanan');
        $jmljenisLayanan = (int) $jmljenisLayanan;
        $datas           = $Model->limit($jmljenisLayanan)->findAll();
        return view('pages/laporan/print/cetak-jenis-layanan.php', ["datas" => $datas]);
    }
}