<?php

namespace App\Repositories;

use App\Entities\Client;
use App\Entities\Image;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Support\Facades\DB;

class ClientRepository
{
    /**
     * @var string
     */
    private $class = 'App\Entities\Client';

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createClient(string $name)
    {
        $client = new Client();
        $client->setName($name);
        $client->setSecret(md5($client->getName()));
        $this->entityManager->persist($client);
        $this->entityManager->flush();
    }
}