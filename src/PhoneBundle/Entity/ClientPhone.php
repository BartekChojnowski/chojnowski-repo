<?php

namespace PhoneBundle\Entity;

use ClientBundle\Entity\Client;
use Doctrine\ORM\Mapping as ORM;

/**
 * ClientPhone
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ClientPhone extends Phone
{
    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="ClientBundle\Entity\Client")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $client;

    /**
     * Get Cliant
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set client
     *
     * @param Client $client
     *
     * @return Client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get subject
     *
     * @return Client
     */
    public function getSubject()
    {
        $this->getClient();
    }
}

