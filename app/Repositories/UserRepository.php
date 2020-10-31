<?php

namespace App\Repositories;

use App\Entities\Client;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use App\Entities\OauthAccessToken;
 
class UserRepository
{
    /**
     * @var string
     */
    private $class = 'App\Entities\User';

        /**
     * @var string
     */
    private $classClient = 'App\Entities\Client';

            /**
     * @var string
     */
    private $classToken = 'App\Entities\OauthAccessToken';

    /**
     * @var EntityManager
     */
    private $entityManager;
 
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
 
    public function create(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
 
    public function getUserById($id)
    {
        return $this->entityManager->getRepository($this->class)->findOneBy([
            'id' => $id
        ]);
    }

    public function getClient($id)
    {
        return $this->entityManager->getRepository($this->classClient)->findOneBy([
            'id' => $id
        ]);
    }

    public function getUserByPhone($phone)
    {
        return $this->entityManager->getRepository($this->class)->findOneBy([
            'phone' => $phone
        ]);
    }
 
    public function delete(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function deleteToken(OauthAccessToken $token)
    {
        $this->entityManager->remove($token);
        $this->entityManager->flush();
        return $token->getToken();
    }

    public function createToken($token)
    {
        $this->entityManager->persist($token);
        $this->entityManager->flush();
    }

    public function checkOauthToken(Client $client, User $user)
    {
        $oAuthToken = $this->entityManager->getRepository($this->classToken)->findOneBy([
            'client' => $client,
            'user' => $user,
        ]);

        if($oAuthToken)
        {
            return $oAuthToken;
        }

        return NULL;
    }

    /**
     * create Post
     * @return User
     */
    private function prepareData($data)
    {
        return new User($data);
    }

    public function checkAuth($token, Client $client, User $user)
    { 
        $userToken = $this->checkOauthToken($client, $user);
        if($userToken){
            if ($token == $userToken->getToken())
            {
                return true;
            }
        }

        return false;
    }
}