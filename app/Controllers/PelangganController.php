<?php
namespace App\Controllers;

use App\Models\Pelanggan;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class PelangganController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new Pelanggan();
        $datas = $model->findAll();
        return view('pages/pelanggan/index.php', ["datas" => $datas]);
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
            'nama'          => 'required|min_length[3]',
            'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
            'nohp'          => 'required|numeric|min_length[10]|max_length[15]',
            'alamat'        => 'required|min_length[5]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('error', 'Terjadi Kesalahan Saat Menyimpan Data');
        }

        $model = new Pelanggan();
        $model->insert([
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'nohp'          => $this->request->getPost('nohp'),
            'alamat'        => $this->request->getPost('alamat'),
        ]);

        return redirect()->to('/pelanggan')->with('success', 'Data pelanggan berhasil ditambahkan.');
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

        $rules = [
            'nama'          => 'required|min_length[3]',
            'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
            'nohp'          => 'required|numeric|min_length[10]|max_length[15]',
            'alamat'        => 'required|min_length[5]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('error', 'Terjadi Kesalahan Saat Menyimpan Data');
        }

        $model = new Pelanggan();
        $model->update($id, [
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'nohp'          => $this->request->getPost('nohp'),
            'alamat'        => $this->request->getPost('alamat'),
        ]);
        return redirect()->to('/pelanggan')->with('success', 'Data pelanggan berhasil diubah.');
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
        $model = new Pelanggan();
        if ($id === null || ! $model->find($id)) {
            return redirect()->to('/pelanggan')->with('error', 'Data tidak ditemukan');
        }
        $model->delete($id);
        return redirect()->to('/pelanggan')->with('success', 'Berhasil menghapus pelanggan!');
    }

    public function laporan()
    {
        $model = new Pelanggan();
        $data  = count($model->findAll());
        return view('pages/laporan/parameter/pelanggan.php', ["data" => $data]);
    }

    public function cetakLaporan()
    {
        $Model        = new Pelanggan();
        $jmlPelanggan = $this->request->getPost('pelanggan');
        $jmlPelanggan = (int) $jmlPelanggan;
        $datas        = $Model->limit($jmlPelanggan)->findAll();
        return view('pages/laporan/print/cetak-pelanggan.php', ["datas" => $datas]);
    }
}