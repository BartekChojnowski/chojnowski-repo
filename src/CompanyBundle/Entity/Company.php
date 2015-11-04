<?php

namespace CompanyBundle\Entity;

use AddressBundle\Entity\CompanyAddress;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company
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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return ArrayCollection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param ArrayCollection $addresses
     */
    public function setAddresses(ArrayCollection $addresses)
    {
        $this->$addresses = $addresses;
    }

    public function addAddress(CompanyAddress $address)
    {
        $this->addresses->add($address);
    }

    public function removeAddress(CompanyAddress $address)
    {
        $this->addresses->removeElement($address);
    }

}

