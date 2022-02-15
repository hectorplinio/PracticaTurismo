<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'created_at'       => [
                'type'           => 'DATETIME',
                'null'     => false,
            ],
            'updated_at'       => [
                'type'           => 'DATETIME',
                'null'     => true,
            ],
            'deleted_at'       => [
                'type'           => 'DATETIME',
                'null'     => true,
            ],

        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('Roles');

    }

    public function down()
    {
        $this->forge->dropTable('Roles');

    }
}
