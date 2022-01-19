<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Restaurants extends Migration
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
            'description'       => [
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
            'reviewAverage'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '50,5',
                'default'       => 0,
            ],
            'numReviews'          => [
                'type'           => 'INT',
                'constraint'     => '250',
                'default'       => '0',
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
        $this->forge->createTable('Restaurants');

    }

    public function down()
    {
        $this->forge->dropTable('Restaurants');

    }
}
