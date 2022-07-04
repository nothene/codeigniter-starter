<?php

namespace App\Controllers;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Response;
use App\Models\NewsModel;

class NewsApi extends BaseController
{
    public function index()
    {
        $request = service('request');
        
        var_dump($request->getUri()->getPath());

        var_dump($request->getServer('Host'));

        var_dump($request->getHeader('host'));
        var_dump($request->getHeader('Content-Type'));

        var_dump($request->getMethod());

        $response = service('response');
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }

    public function view($slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if(empty($data['news'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            .view('news/view')
            .view('templates/footer');        
    }

    public function create(){
        $model = model(NewsModel::class);

        if($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required',
        ])) 
        {
            $model->save([
                'title' => $this->request->getPost('title'),
                'slug' => url_title($this->request->getPost('title'), '-', true),
                'body' => $this->request->getPost('body'),
            ]);

            return view('news/success');
        }

        return view('templates/header', ['title' => 'Create a news item'])
            .view('news/create')
            .view('templates/footer');
    }
}