<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use Throwable;

class UserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        $builder = $this->db->table('users');

        $builder->emptyTable();
        
        $data = [
            [
                'name'     => 'Adam',
                'email'    => 'adam@dmail.com',
            ],
            [
                'name'     => 'Enoch',
                'email'    => 'enoch@dmail.com',
            ],
            [
                'name'     => 'Noah',
                'email'    => 'noah@dmail.com',
            ],
            [
                'name'     => 'Heber',
                'email'    => 'heber@dmail.com',
            ],
            [
                'name'     => 'Ishmael',
                'email'    => 'ishmael@dmail.com',
            ],
            [
                'name'     => 'Joseph',
                'email'    => 'joseph@dmail.com',
            ],
            [
                'name'     => 'David',
                'email'    => 'david@dmail.com',
            ],                                                                        
        ];     

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        // single insert
        //$this->db->table('users')->insert($data);

        // batch insert
        $builder->insertBatch($data);

        // try{
        //     $this->db->table('users')->insert($data);
        // } catch(Throwable $e){
        //     echo 'Duplicate detected' . PHP_EOL;
        //     var_dump($data);
        // }        
    }
}