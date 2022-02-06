<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Weather extends Migration
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
            'main'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'description'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'icon'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'celsius'       => [
                'type'           => 'INT',
                'constraint'     => '5',
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
        $this->forge->createTable('Weather');
    }

    public function down()
    {
        $this->forge->dropTable('Weather');
    }
}
