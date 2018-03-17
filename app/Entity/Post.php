<?php

namespace App\Entity;


/**
 * Class Post
 * @package App\Entity
 * @Collection posts
 */
class Post extends BaseEntity
{
    /**
     * @mapping id
     */
    public $id;

    /**
     * @mapping userId
     */
    public $userId;

    /**
     * @mapping title
     */
    public $title;

    /**
     * @mapping body
     */
    public $body;

    /**
     * @var Comment[]
     */
    protected $comments;

    /**
     * @var integer
     */
    public $countOfComments;

    protected function loadComments()
    {
        $objs = $this->entityLoader->load(Comment::class, null, ["postId" => $this->id]);
        $this->countOfComments = count($objs);
        return $objs;
    }

}