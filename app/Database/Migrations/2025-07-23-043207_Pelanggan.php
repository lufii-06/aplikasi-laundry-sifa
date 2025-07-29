<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'          => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['Perempuan', 'Laki-laki'],
                'default'    => "Laki-laki",
            ],
            'nohp'          => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],
            'alamat'        => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at'    => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'    => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pelanggans');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggans');
    }
}