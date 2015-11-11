<?php

namespace AddressBundle\Entity;

use UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserAddress
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserAddress extends Address
{
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $user;

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getSubject()
    {
        $this->getUser();
    }
}

