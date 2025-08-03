<?php
namespace App\Controllers;

use App\Models\CucianMasuk;
use App\Models\JenisCucian;
use App\Models\User;

class Home extends BaseController
{
    public function index(): string
    {
        $modelJenisCucian = new JenisCucian();
        $model            = new CucianMasuk();
        $jenisCucian      = $modelJenisCucian->select('jenis_cucians.*,jenis_layanans.nama_layanan')->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')->findAll();

        $datas = $model->getWithDetail();
        return view('pages/index.php', [
            "datas"             => $datas,
            "jmlSemuaTransaksi" => count($datas),
            "jmlJenisCucian"    => count($jenisCucian),
        ]);
    }

    public function login()
    {
        $user = session()->get('user');
        if ($user) {
            return redirect()->to('/home');
        }
        return view('pages/auth/login.php');
    }
    public function unauthorized()
    {
        return view('errors/unauthorized.php');
    }
    public function loginAction()
    {
        $session  = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username dan Password wajib diisi.')->withInput();
        }
        $model = new User();
        $user  = $model->where('username', $username)->get()->getRow();
        if ($user && password_verify($password, $user->password)) {
            $session->set([
                'user'       => $user,
                'isLoggedIn' => true,
            ]);
            return redirect()->to('/home');
        } else {
            return redirect()->back()->with('error', 'Login gagal. Periksa kembali username dan password.');
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

}