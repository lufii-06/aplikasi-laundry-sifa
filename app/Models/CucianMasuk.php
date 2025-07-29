<?php
namespace App\Models;

use CodeIgniter\Model;

class CucianMasuk extends Model
{
    protected $table            = 'cucian_masuks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'id_pelanggan',
        'id_cucian',
        'tgl_masuk',
        'tgl_selesai',
        'tgl_ambil',
        'qty',
        'total',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts        = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getWithDetail()
    {
        return $this->select('cucian_masuks.*, pelanggans.nama AS nama_pelanggan, jenis_cucians.nama_cucian AS nama_cucian')
            ->join('pelanggans', 'pelanggans.id = cucian_masuks.id_pelanggan')
            ->join('jenis_cucians', 'jenis_cucians.id = cucian_masuks.id_cucian')
            ->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')
            ->orderBy('cucian_masuks.created_at', 'DESC')
            ->findAll();
    }
    public function getWithDetailCucianSelesai()
    {
        return $this->select('cucian_masuks.*, pelanggans.nama AS nama_pelanggan, jenis_cucians.nama_cucian AS nama_cucian')
            ->join('pelanggans', 'pelanggans.id = cucian_masuks.id_pelanggan')
            ->join('jenis_cucians', 'jenis_cucians.id = cucian_masuks.id_cucian')
            ->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')
            ->where('cucian_masuks.status', "SUDAH DI AMBIL")
            ->findAll();
    }

    public function getTransaksiPerid($id, $nohp)
    {
        return $this->select('cucian_masuks.*,
            pelanggans.nama AS nama_pelanggan,
            pelanggans.alamat AS alamat,
            pelanggans.nohp AS nohp,
            jenis_cucians.nama_cucian AS nama_cucian')
            ->join('pelanggans', 'pelanggans.id = cucian_masuks.id_pelanggan')
            ->join('jenis_cucians', 'jenis_cucians.id = cucian_masuks.id_cucian')
            ->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')
            ->where('cucian_masuks.id', $id)
            ->where('pelanggans.nohp', $nohp)
            ->findAll();
    }
    public function getTransaksifakturperSatuan($satuan)
    {
        return $this->select('cucian_masuks.*,
            pelanggans.nama AS nama_pelanggan,
            jenis_cucians.nama_cucian AS nama_cucian,
            jenis_cucians.harga AS harga,
            jenis_layanans.nama_layanan AS nama_layanan')
            ->join('pelanggans', 'pelanggans.id = cucian_masuks.id_pelanggan')
            ->join('jenis_cucians', 'jenis_cucians.id = cucian_masuks.id_cucian')
            ->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')
            ->orderBy('cucian_masuks.created_at', 'DESC')
            ->where('cucian_masuks.status', "MASUK")
            ->where('jenis_cucians.satuan', $satuan)
            ->findAll();
    }
    public function getTransaksiPertanggal($tanggal)
    {
        return $this->select('cucian_masuks.*,
            pelanggans.nama AS nama_pelanggan,
            jenis_cucians.nama_cucian AS nama_cucian,
            jenis_cucians.harga AS harga,
            jenis_layanans.nama_layanan AS nama_layanan')
            ->join('pelanggans', 'pelanggans.id = cucian_masuks.id_pelanggan')
            ->join('jenis_cucians', 'jenis_cucians.id = cucian_masuks.id_cucian')
            ->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')
            ->orderBy('cucian_masuks.created_at', 'DESC')
            ->where('cucian_masuks.status', "SUDAH DI AMBIL")
            ->where('cucian_masuks.tgl_ambil', $tanggal)
            ->findAll();
    }
    public function getTransaksiPerbulan($bulan)
    {
        return $this->select('cucian_masuks.*,
        pelanggans.nama AS nama_pelanggan,
        jenis_cucians.nama_cucian AS nama_cucian,
        jenis_cucians.harga AS harga,
        jenis_layanans.nama_layanan AS nama_layanan')
            ->join('pelanggans', 'pelanggans.id = cucian_masuks.id_pelanggan')
            ->join('jenis_cucians', 'jenis_cucians.id = cucian_masuks.id_cucian')
            ->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')
            ->orderBy('cucian_masuks.created_at', 'DESC')
            ->where('cucian_masuks.status', "SUDAH DI AMBIL")
            ->like('cucian_masuks.tgl_ambil', $bulan, 'after') // cocokkan prefix YYYY-MM
            ->findAll();
    }
    public function getTransaksiPertahun($tahun)
    {
        return $this->select('MONTH(cucian_masuks.tgl_ambil) AS bulan, SUM(cucian_masuks.total) AS total_per_bulan')
            ->join('pelanggans', 'pelanggans.id = cucian_masuks.id_pelanggan')
            ->join('jenis_cucians', 'jenis_cucians.id = cucian_masuks.id_cucian')
            ->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')
            ->where('cucian_masuks.status', "SUDAH DI AMBIL")
            ->where('YEAR(cucian_masuks.tgl_ambil)', $tahun)
            ->groupBy('MONTH(cucian_masuks.tgl_ambil)')
            ->orderBy('MONTH(cucian_masuks.tgl_ambil)', 'ASC')
            ->findAll();
    }

    public function getTransaksifaktur($id)
    {
        return $this->select('cucian_masuks.*,
            pelanggans.nama AS nama_pelanggan,
            pelanggans.alamat AS alamat,
            jenis_cucians.satuan AS satuan,
            jenis_cucians.harga AS harga,
            jenis_cucians.nama_cucian AS nama_cucian', )
            ->join('pelanggans', 'pelanggans.id = cucian_masuks.id_pelanggan')
            ->join('jenis_cucians', 'jenis_cucians.id = cucian_masuks.id_cucian')
            ->join('jenis_layanans', 'jenis_layanans.id = jenis_cucians.id_layanan')
            ->where('cucian_masuks.id', $id)
            ->first();
    }
}