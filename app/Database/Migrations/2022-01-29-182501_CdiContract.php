<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CdiContract extends Migration
{
    public function up()
    {
        $this->forge->addField(
            array(
                'id' => array(
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'auto_increment' => true,
                ),
                'nume' => array(
                    'type'       => 'VARCHAR',
                    'constraint' => 128,
                ),
                'sex' => array(
                    'type'       => 'CHAR',
                    'constraint' => 1,
                ),
                'cnp' => array(
                    'type'       => 'VARCHAR',
                    'constraint' => 128,
                    'default' => null
                ),
                'email' => array(
                    'type'       => 'VARCHAR',
                    'constraint' => 128,
                ),
                'tel' => array(
                    'type'  => 'LONGTEXT',
                    'default' => null
                ),
                'data' => array(
                    'type'       => 'VARCHAR',
                    'constraint' => 128,
                    'default' => null
                ),
                'created_at' => array(
                    'type' => 'DATETIME',
                    'null' => true,
                    'default' => null
                ),
                'updated_at' => array(
                    'type' => 'DATETIME',
                    'null' => true,
                    'default' => null
                ),
                'deleted' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                    'null' => false,
                    'default' => 0
                )
            ),
        );
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('cdi_contract');
    }

    public function down()
    {
        $this->forge->dropTable('cdi_contract');
    }
}
