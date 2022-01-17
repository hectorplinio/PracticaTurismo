<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GasStations extends Migration
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
            'label'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'address'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'latitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '50,15',
            ],
            'longitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '50,15',
            ],
            'idees'          => [
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
        $this->forge->createTable('GasStations');

    }

    public function down()
    {
        $this->forge->dropTable('GasStations');

    }
}
