<?php

namespace App\Entity;


/**
 * Class User
 * @package App\Entity
 * @Collection users
 */
class User extends BaseEntity
{
    /**
     * @mapping id
     */
    public $id;

    /**
     * @mapping name
     */
    public $name;

    /**
     * @mapping username
     */
    public $username;

    /**
     * @mapping email
     */
    public $email;

    /**
     * @mapping phone
     */
    public $phone;

    /**
     * @mapping website
     */
    public $website;

    //TODO: add possibility to load sub objects as address and company

    /**
     * @var Post[]
     */
    protected $posts;

    /**
     * @var integer
     */
    public $countOfPosts;

    protected function loadPosts()
    {
        $objs = $this->entityLoader->load(Post::class, null, ["userId" => $this->id]);
        $this->countOfPosts = count($objs);
        return $objs;
    }


}