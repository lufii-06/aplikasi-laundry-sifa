<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingPageController::index');
$routes->get('/login', 'Home::login');
// $routes->get('/register', 'Home::register');
$routes->get('/logout', 'Home::logout');

$routes->post('/login', 'Home::loginAction');
// $routes->post('/register', 'Home::registerAction');
$routes->get('/unauthorized', 'Home::unauthorized');

$routes->group('', ['filter' => 'role:ADMIN,KARYAWAN'], function ($routes) {
    $routes->resource('pelanggan', ['controller' => 'PelangganController']);
    $routes->resource('jenis-cucian', ['controller' => 'JenisCucianController']);
    $routes->resource('jenis-layanan', ['controller' => 'JenisLayananController']);
    $routes->resource('cucian-masuk', ['controller' => 'CucianMasukController']);
    $routes->resource('cucian-selesai', ['controller' => 'CucianSelesaiController']);
    $routes->put('update-status-cucian-masuk/(:num)', 'CucianMasukController::updateStatusCucian/$1');
});

$routes->group('', ['filter' => 'role:ADMIN,KARYAWAN,PIMPINAN'], function ($routes) {

    $routes->get('/home', 'Home::index');
    $routes->get('/laporan-pelanggan', 'PelangganController::laporan');
    $routes->post('/cetak-laporan-pelanggan', 'PelangganController::cetakLaporan');

    $routes->get('/laporan-jenis-cucian', 'JenisCucianController::laporan');
    $routes->post('/cetak-laporan-jenis-cucian', 'JenisCucianController::cetakLaporan');

    $routes->get('/laporan-jenis-layanan', 'JenisLayananController::laporan');
    $routes->post('/cetak-laporan-jenis-layanan', 'JenisLayananController::cetakLaporan');

    $routes->get('/laporan-transaksi-cucian-masuk', 'CucianMasukController::laporanTransaksiCucianMasuk');
    $routes->post('/cetak-laporan-transaksi-cucian-masuk', 'CucianMasukController::cetakLaporanTransaksiCucianMasuk');

    $routes->get('/laporan-transaksi-pertanggal', 'CucianMasukController::laporanTransaksiPertanggal');
    $routes->get('/laporan-transaksi-perbulan', 'CucianMasukController::laporanTransaksiPerbulan');
    $routes->get('/laporan-transaksi-pertahun', 'CucianMasukController::laporanTransaksiPertahun');

    $routes->get('/cetak-laporan-faktur-transaksi/(:num)', 'CucianMasukController::cetakLaporanFakturTransaksi/$1');
    $routes->post('/cetak-laporan-transaksi-pertanggal', 'CucianMasukController::cetakLaporanPertanggal');
    $routes->post('/cetak-laporan-transaksi-perbulan', 'CucianMasukController::cetakLaporanperbulan');
    $routes->post('/cetak-laporan-transaksi-pertahun', 'CucianMasukController::cetakLaporanpertahun');

    $routes->post('/cetak-laporan-pembayaran-pertanggal', 'PembayaranController::cetakLaporanPertanggal');
    $routes->post('/cetak-laporan-pembayaran-perbulan', 'PembayaranController::cetakLaporanPerbulan');
    $routes->post('/cetak-laporan-pembayaran-pertahun', 'PembayaranController::cetakLaporanPertahun');
    $routes->get('/laporan-pembayaran-pertanggal', 'PembayaranController::laporanPembayaranPertanggal');
    $routes->get('/laporan-pembayaran-perbulan', 'PembayaranController::laporanPembayaranPerbulan');
    $routes->get('/laporan-pembayaran-pertahun', 'PembayaranController::laporanPembayaranPertahun');

    $routes->get('/laporan-jadwal-pemotretan', 'JadwalPemotretanController::laporanJadwalPertanggal');
    $routes->post('/cetak-laporan-jadwal-pemotretan-pertanggal', 'JadwalPemotretanController::cetakLaporanJadwalPertanggal');
});

$routes->post('/cetak-laporan-transaksi-perid', 'CucianMasukController::cetakLaporanPerId');

$routes->get('/jenis_cucian/(:segment)', 'CucianMasukController::getByIds/$1');