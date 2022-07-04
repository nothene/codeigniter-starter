<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveNameUniqueness extends Migration
{
    public function up()
    {
        $fields = [
            'email' => [
                // name key is used to rename column name
                'name' => 'email',
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => false,
            ],
        ];
        $this->forge->modifyColumn('users', $fields);
    }

    public function down()
    {
        $fields = [
            'email' => [
                // name key is used to rename column name
                'name' => 'email',
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
        ];
        $this->forge->modifyColumn('users', $fields);
    }
}
