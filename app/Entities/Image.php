<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * Class Image
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="images")
 */
class Image
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
    protected $url;
}