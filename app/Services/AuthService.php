<?php

namespace App\Services;

use App\Entities\OauthAccessToken;
use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\UserRepository as UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private $repository;
 
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function loginUser(Request $request)
    {
        $client = $this->repository->getClient($request->client_id);
        $user = $this->repository->getUserByPhone($request->phone);
        $token = $this->createToken();

        $oauthToken = $this->repository->checkOauthToken($client, $user);

        if(!$oauthToken)
        {
            $oauthToken = new OauthAccessToken();
            $oauthToken->setUserId($user);
            $oauthToken->setClientId($client);
        }

        $oauthToken->setToken($token);

        $this->repository->createToken($oauthToken);

        return $token;
    }

    public function registrateUser(Request $request)
    {
        $user = new User();
        $user->setName($request->name);
        $user->setPhone($request->phone);
        $user->setPassword(md5($request->password));

        $this->repository->create($user);
    }

    public function logoutUser(Request $request)
    {
        $client = $this->repository->getClient($request->client_id);
        $user = $this->repository->getUserByPhone($request->phone);

        $token = $this->repository->checkOauthToken($client, $user);

        return $this->repository->deleteToken($token);
    }

    public function checkUser(Request $request)
    {
        $user = $this->repository->getUserByPhone($request->phone);

        if(!$user || ($user && $user->getPassword() != md5($request->password))){
            return false;
        }

        return true;
    }

    public function checkClient(Request $request)
    {
        $client = $this->repository->getClient($request->client_id);

        if(!$client || ($client && $client->getSecret() != $request->client_secret)){
            return false;
        }

        return true;
    }

    protected function createToken()
    {
        $token = Str::random(80);
        return hash('sha256', $token);
    }
}