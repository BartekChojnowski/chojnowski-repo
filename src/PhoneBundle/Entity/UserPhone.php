<?php

namespace PhoneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * UserPhone
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserPhone extends Phone
{
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $user;

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return UserPhone
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get subject
     *
     * @return User
     */
    public function getSubject()
    {
        $this->getUser();
    }
}

