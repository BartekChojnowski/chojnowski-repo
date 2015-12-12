<?php

namespace CompanyBundle\Entity;

use AddressBundle\Entity\CompanyAddress;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Company
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="taxId", type="string", length=16)
     */
    protected $taxId;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80)
     */
    protected $email;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AddressBundle\Entity\CompanyAddress", mappedBy="company")
     **/
    protected $addresses;

    /**
     * Contruct
     */
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set taxId
     *
     * @param string $taxId
     *
     * @return Company
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;

        return $this;
    }

    /**
     * Get taxId
     *
     * @return string
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Company
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get addresses
     *
     * @return ArrayCollection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Set addresses
     *
     * @param ArrayCollection $addresses
     *
     * @return Company
     */
    public function setAddresses(ArrayCollection $addresses)
    {
        $this->$addresses = $addresses;

        return $this;
    }

    /**
     * Add address
     *
     * @param CompanyAddress $address
     *
     * @return Company
     */
    public function addAddress(CompanyAddress $address)
    {
        $this->addresses->add($address);

        return $this;
    }

    /**
     * Remove address
     *
     * @param CompanyAddress $address
     *
     * @return Company
     */
    public function removeAddress(CompanyAddress $address)
    {
        $this->addresses->removeElement($address);

        return $this;
    }

}

