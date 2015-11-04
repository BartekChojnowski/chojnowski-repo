<?php

namespace PhoneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * UserPhone
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserPhone extends Phone
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

    public function getSubject()
    {
        $this->getUser();
    }
}

