<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CucianMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user'      => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'id_pelanggan' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'id_cucian'    => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'tgl_masuk'    => [
                'type' => 'DATE',
            ],
            'tgl_selesai'  => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tgl_ambil'    => [
                'type' => 'DATE',
                'null' => true,
            ],
            'qty'          => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'total'        => [
                'type' => 'DOUBLE',
                'null' => true,
            ],
            'status'       => [
                'type'       => 'ENUM',
                'constraint' => ['MASUK', 'DI PROSES', 'SELESAI', 'SUDAH DI AMBIL'],
                'default'    => 'MASUK',
            ],
            'created_at'   => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'   => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pelanggan', 'pelanggans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_cucian', 'jenis_cucians', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cucian_masuks');
    }

    public function down()
    {
        $this->forge->dropTable('cucian_masuks');
    }
}