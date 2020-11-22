<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * Class Post
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection|Image[]
     *
     * @ORM\ManyToMany(targetEntity="Image", inversedBy="posts")
     * @ORM\JoinTable(
     *  name="post_image",
     *  joinColumns={
     *      @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     *  }
     * )
     */
    protected $image_id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="User", cascade="persist")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $user_id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Text", cascade="persist")
     * @ORM\JoinColumn(name="text_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $text_id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Status", cascade="persist")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $status_id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

}