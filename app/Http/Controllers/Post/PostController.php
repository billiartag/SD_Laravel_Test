<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public $serverUrl = "http://127.0.0.1:8001/api";

    public function indexPost(Request $request)
    {
        $data = $this->getPost($request->input('id'));

        return view('post.post', $data);
    }

    public function getPost($id)
    {

        $client = new Client();
        $url = $this->serverUrl . '/post/' . $id;

        try {
            $response = $client->request('GET', $url,
                [
                    'headers' => ['Content-type' => 'application/json',
                        'Authorization' => 'Bearer ' . session('token'),
                        'Accept' => 'application/json',
                    ],
                ]);

            $code = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            if ($code == Response::HTTP_OK) {
                // redirect to home
                return [
                    'post' => $content['post'],
                    'comments' => $content['comments'],
                    'like' => $content['like'],
                ];
            }

        } catch (ClientException  $e) {
            $response = $e->getResponse();
            $code = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            if ($code == Response::HTTP_NOT_FOUND) {
                session()->flash('error', $content['error']);
                return [];
            }
        }

    }

}
