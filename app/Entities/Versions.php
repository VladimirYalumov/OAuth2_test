<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Version
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="versions")
 */
class Version
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", cascade="persist")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Client", cascade="persist")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    protected $client;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $version;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;
}