<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    public $serverUrl = "http://127.0.0.1:8001/api";

    public function indexLogin()
    {
        return view('auth.login');
    }

    public function login($credentials)
    {
        $client = new Client();
        $url = $this->serverUrl . '/auth/login';

        try {
            $response = $client->request('POST', $url,
                [
                    'headers' => ['Content-type' => 'application/json'],
                    'body' => json_encode($credentials),
                ]);

            $code = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            if ($code == Response::HTTP_OK) {
                session([
                    'token' => $content['token'],
                ]);

                // redirect to home
                return redirect()->route('postsScreen');
            }

        } catch (ClientException  $e) {
            $response = $e->getResponse();
            $code = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            if ($code == Response::HTTP_NOT_FOUND) {
                session()->flash('error', $content['error']);
            }
        }


    }

    public function register($credentials)
    {
        $client = new Client();
        $url = $this->serverUrl . '/auth/register';

        try {
            $response = $client->request('POST', $url,
                [
                    'headers' => ['Content-type' => 'application/json'],
                    'body' => json_encode($credentials),
                ]);

            $code = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            if ($code == Response::HTTP_OK) {
                session([
                    'token' => $content['token'],
                ]);
                // redirect to home
                return redirect()->route('postsScreen');
            }

        } catch (ClientException  $e) {
            $response = $e->getResponse();
            $code = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            if ($code == Response::HTTP_NOT_FOUND) {
                session()->flash('error', $content['error']);
            }
        }


    }

    public function logout()
    {
        $client = new Client();
        $url = $this->serverUrl . '/auth/logout';

        try {
            $response = $client->request('POST', $url,
                [
                    'headers' => [
                        'Content-type' => 'application/json',
                        'Authorization' => 'Bearer ' . session('token'),
                        'Accept' => 'application/json'
                    ],
                ]);

            $code = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            if ($code == Response::HTTP_OK) {
                session()->remove('token');
                // redirect to home
                return redirect()->route('loginScreen');
            }

        } catch (ClientException  $e) {
            $response = $e->getResponse();
            $code = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);

            if ($code == Response::HTTP_NOT_FOUND) {
                session()->flash('error', $content['error']);
            }
        }
    }
}
