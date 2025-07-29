<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisCucian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_layanan'  => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'nama_cucian' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'harga'       => [
                'type' => 'double',
            ],
            'satuan'      => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addForeignKey('id_layanan', 'jenis_layanans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis_cucians');
    }

    public function down()
    {
        $this->forge->dropTable('jenis_cucians');
    }
}