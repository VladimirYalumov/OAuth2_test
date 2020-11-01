<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OauthAccessToken
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="oauth_access_tokens")
 */
class OauthAccessToken
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
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $pushToken;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    public function setUserId($user)
    {
        $this->user = $user;
    }

    public function setClientId($client)
    {
        $this->client = $client;
    }

    public function setToken($token)
    {
        $this->name = $token;
    }

    public function getToken()
    {
        return $this->name;
    }

    public function setPush($push)
    {
        $this->pushToken = $push;
    }

}