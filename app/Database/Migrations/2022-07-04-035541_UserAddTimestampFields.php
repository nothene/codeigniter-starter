<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class UserAddTimestampFields extends Migration
{
    public function up()
    {
        $fields = [
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new Rawsql('CURRENT_TIMESTAMP'),                
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'default' => null,                
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'default' => null,                
            ],                        
        ];
        $this->forge->addColumn('users', $fields);        
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['created_at', 'deleted_at', 'updated_at']);
    }
}
