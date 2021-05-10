<?php

namespace App\Repositories;

use App\Entities\Image;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Support\Facades\DB;

class PostRepository
{
    /**
     * @var string
     */
    private $class = 'App\Entities\Post';

    /**
     * @var string
     */
    private $classImage = 'App\Entities\Image';

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Image $image)
    {
        $this->entityManager->persist($image);
        $this->entityManager->flush();
    }
}