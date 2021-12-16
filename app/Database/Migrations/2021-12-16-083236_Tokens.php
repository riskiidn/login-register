<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tokens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('tokens');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
