<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 04.05.16
 * Time: 11:41
 */

namespace AppBundle\Entity;


class Article
{
    private $title;
    private $slug;
    private $description;
    private $content;
    private $create_at;
    private $update_at;
    private $public_at;
    private $category_id;
    private $author_id;
    private $status;
}