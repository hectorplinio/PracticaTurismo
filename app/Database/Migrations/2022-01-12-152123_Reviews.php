<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reviews extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'description'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'punctuation'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '65',
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'restaurant_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null' => true
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
        $this->forge->addForeignKey('restaurant_id', 'Restaurants','id','CASCADE', 'SET NULL');
        $this->forge->createTable('Reviews');
        $this->db->enableForeignKeyChecks();

    }

    public function down()
    {
        $this->forge->dropTable('Reviews');

    }
}
