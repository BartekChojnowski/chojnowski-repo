<?php

namespace PhoneBundle\Entity;

use ClientBundle\Entity\Client;
use Doctrine\ORM\Mapping as ORM;

/**
 * ClientPhone
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ClientPhone extends Phone
{
    /**
     * @ORM\ManyToOne(targetEntity="ClientBundle\Entity\Client")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $client;

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    public function getSubject()
    {
        $this->getClient();
    }
}

