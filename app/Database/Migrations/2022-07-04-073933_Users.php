<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'user_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'user_email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'user_password' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'user_status' => [
                'type' => 'ENUM',
                'constraint' => ['Active', 'Inactive'],
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
    }
}
