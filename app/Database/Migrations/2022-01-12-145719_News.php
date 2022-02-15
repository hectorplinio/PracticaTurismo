<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class News extends Migration
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
            'title'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'description'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'pubDate'       => [
                'type'           => 'DATETIME',
                'null'     => true,
            ],
            'url'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'guid'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'img_url'       => [
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
        $this->forge->createTable('News');
    }

    public function down()
    {
        $this->forge->dropTable('News');

    }
}
