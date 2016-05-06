<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 05.05.16
 * Time: 15:12
 */

namespace BlogBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package BlogBundle\Entity
 * @ORM\Entity
 * @ORM\Table(
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}