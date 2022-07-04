<?php

namespace App\Controllers;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\Request;
use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;
use Throwable;

class UserApi extends BaseController
{
    public function index($id = null, $id2 = null, $id3 = null)
    {
        // $uri = $this->request->getUri();
        // $queries = $uri->getSegments();

        // var_dump($this->request->getGet());       

        $userModel = model('UserModel', true);
        if($id == null){
            $data = $userModel->find();
    
            $uri = $this->request->getUri();
            $queries = $uri->getQuery();
    
            //var_dump($this->request->getIPAddress());
    
            return $this->response->setStatusCode(200)->setJSON($data);
        }
        else {
            $data = $userModel->find($id);

            if($data == null){
                return $this->response->setStatusCode(404)->setJSON('failed');
            }

            echo $id . " " . $id2 . " " . $id3 . PHP_EOL;
    
            return $this->response->setStatusCode(200)->setJSON($data);
        }
    }

    public function create($name, $email){
        $userModel = model('UserModel', true);

        $data = [
            'name' => $name,
            'email' => $email,
        ];

        try {
            $userModel->save($data);
            return $this->response->setStatusCode(200)->setJSON('Create successful');
        } catch(Throwable $e){
            return $this->response->setStatusCode(404)->setJSON('Create failed');
        }   
    }

    public function update($id, $name = null, $email = null){
        $userModel = model('UserModel', true);

        if($name != null) {
            $data['name'] = $name;
        }

        if($email != null) {
            $data['email'] = $email;
        }

        if(!$userModel->find($id)){
            return $this->response->setStatusCode(404)->setJSON('id not found');
        }

        try {
            $userModel->update($id, $data);
            return $this->response->setStatusCode(200)->setJSON('Update successful');
        } catch(Throwable $e){
            return $this->response->setStatusCode(404)->setJSON('Update failed due to the email already in use');
        }   
    }    

    public function delete($id = null){
        $userModel = model('UserModel', true);

        if($id == null){
            return $this->response->setStatusCode(404)->setJSON('Please specify an id to delete');   
        }

        if($userModel->find($id) != null){
            $userModel->where('id', $id)->delete();
            return $this->response->setStatusCode(200)->setJSON('User ' . $id . ' successfully deleted');
        } else {
            return $this->response->setStatusCode(404)->setJSON('User ' . $id . ' not found');
        }
    }
}