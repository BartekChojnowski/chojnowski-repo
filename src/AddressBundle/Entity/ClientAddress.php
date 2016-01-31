<?php

namespace AddressBundle\Entity;

use ClientBundle\Entity\Client;
use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa reprezentuje adres klienta
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class ClientAddress extends Address
{
    /**
     * Klient
     *
     * @ORM\ManyToOne(targetEntity="ClientBundle\Entity\Client")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $client;

    /**
     * Metoda zwraca klient
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Metoda ustawia klienta
     *
     * @param Client $client Klient
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Metoda zwraca podmiot, którego dotyczy adres
     *
     * @return Client
     */
    public function getSubject()
    {
        $this->getClient();
    }
}

