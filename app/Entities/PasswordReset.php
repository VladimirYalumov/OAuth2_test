<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PasswordReset
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="password_reset", indexes={@ORM\Index(name="user_id_token_index", columns={"user_id"})})
 */
class PasswordReset
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string", length=100)
     */
    protected $id;

    /**
     * @var int
     * @ORM\OneToOne(targetEntity="User", cascade="persist")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL", unique=true)
     */
    protected $userId;

    /**
     * @var int
     * @ORM\Column(name="sms_code", type="string")
     */
    protected $sms_code;

    /**
     * @var string
     * @ORM\Column(name="token", type="string")
     */
    protected $token;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

}