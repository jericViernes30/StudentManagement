<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubjectsTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'subject_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true
        ],
        'subject_code' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
        ],
        'subject_name' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'deleted_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);

    $this->forge->addKey('subject_id', true);
    $this->forge->createTable('subjects');
}


    public function down()
    {
        $this->forge->dropTable('subjects', true);
    }
}
