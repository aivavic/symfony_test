<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 05.05.16
 * Time: 13:52
 */

namespace AppBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class WsseUserToken extends AbstractToken
{

    public $created;
    public $digest;
    public $nonce;

    public function __construct(array $roles = [])
    {
        parent::__construct($roles);

        $this->setAuthenticated(count($roles)>0);
    }
    public function getCredentials()
    {
        // TODO: Implement getCredentials() method.
        return '';
    }


}