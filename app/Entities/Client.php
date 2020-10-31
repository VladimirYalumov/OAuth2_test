<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * Class Client
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="clients")
 */
class Client
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(name="secret", type="string", length=100)
     */
    protected $secret;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    public function getSecret(){
        return $this->secret;
    }

    public function getId()
    {
        return $this->id;
    }

}