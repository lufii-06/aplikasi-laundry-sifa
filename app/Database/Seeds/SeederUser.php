<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederUser extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'level'    => 'ADMIN',
            ],
            [
                'username' => 'karyawan',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'level'    => 'KARYAWAN',
            ],
            [
                'username' => 'pimpinan',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'level'    => 'PIMPINAN',
            ],
        ];

        // Insert multiple users
        $this->db->table('users')->insertBatch($data);
    }
}