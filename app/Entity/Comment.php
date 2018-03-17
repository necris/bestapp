<?php

namespace App\Entity;


/**
 * Class Comment
 * @package App\Entity
 * @Collection comments
 */
class Comment extends BaseEntity
{
    /**
     * @mapping id
     */
    public $id;

    /**
     * @mapping postId
     */
    public $postId;

    /**
     * @mapping name
     */
    public $name;

    /**
     * @mapping email
     */
    public $email;

    /**
     * @mapping body
     */
    public $body;

}