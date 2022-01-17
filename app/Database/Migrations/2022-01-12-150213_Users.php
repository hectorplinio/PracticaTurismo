<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'username'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
                'unique'         => true,
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
                'unique'         => true,
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'surname'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '250',
            ],
            'rol_id'          => [
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
        $this->forge->addForeignKey('rol_id', 'Roles','id','CASCADE', 'SET NULL');
        $this->forge->createTable('Users');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('Users');

    }
}
