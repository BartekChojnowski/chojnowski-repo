<?php

namespace CompanyBundle\Entity;

use AddressBundle\Entity\UserAddress;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PhoneBundle\Entity\Phone;
use PhoneBundle\Entity\UserPhone;

/**
 * Employee
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Employee
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=60)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=60)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="personalId", type="string", length=11)
     */
    private $personalId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfBirth", type="datetime")
     */
    private $dateOfBirth;

    /**
     * @ORM\ManyToOne(targetEntity="Position")
     * @ORM\JoinColumn(name="position", referencedColumnName="id")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="EmployeeStatus")
     * @ORM\JoinColumn(name="status", referencedColumnName="id")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="employmentStart", type="datetime")
     */
    private $employmentStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="employmentEnd", type="datetime")
     */
    private $employmentEnd;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AddressBundle\Entity\CompanyAddress", mappedBy="company")
     **/
    private $addresses;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AddressBundle\Entity\CompanyAddress", mappedBy="company")
     **/
    private $phones;

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Employee
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Employee
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set personalId
     *
     * @param string $personalId
     *
     * @return Employee
     */
    public function setPersonalId($personalId)
    {
        $this->personalId = $personalId;

        return $this;
    }

    /**
     * Get personalId
     *
     * @return string
     */
    public function getPersonalId()
    {
        return $this->personalId;
    }

    /**
     * Get dateOfBirth
     *
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set dateOfBirth
     *
     * @param string $dateOfBirth
     *
     * @return Employee
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Set position
     *
     * @param Position $position
     *
     * @return Employee
     */
    public function setPosition(Position $position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set status
     *
     * @param EmployeeStatus $status
     *
     * @return Employee
     */
    public function setStatus(EmployeeStatus $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return EmployeeStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set employmentStart
     *
     * @param \DateTime $employmentStart
     *
     * @return employee
     */
    public function setEmploymentStart(\DateTime $employmentStart)
    {
        $this->employmentStart = $employmentStart;

        return $this;
    }

    /**
     * Get employmentStart
     *
     * @return \DateTime
     */
    public function getEmploymentStart()
    {
        return $this->employmentStart;
    }

    /**
     * Set employmentEnd
     *
     * @param \DateTime $employmentEnd
     *
     * @return Employee
     */
    public function setEmploymentEnd(\DateTime $employmentEnd)
    {
        $this->employmentEnd = $employmentEnd;

        return $this;
    }

    /**
     * Get employmentEnd
     *
     * @return \DateTime
     */
    public function getEmploymentEnd()
    {
        return $this->employmentEnd;
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
     * @return Employee
     */
    public function setAddresses(ArrayCollection $addresses)
    {
        $this->addresses = $addresses;
        return $this;
    }

    /**
     * Add address
     *
     * @param UserAddress $address
     *
     * @return Employee
     */
    public function addAddress(UserAddress $address)
    {
        $this->addresses->add($address);

        return $this;
    }

    /**
     * Remove address
     *
     * @param UserAddress $address
     *
     * @return Employee
     */
    public function removeAddress(UserAddress $address)
    {
        $this->addresses->removeElement($address);

        return $this;
    }

    /**
     * Get phones
     *
     * @return ArrayCollection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Set phones
     *
     * @param ArrayCollection $phones
     *
     * @return Employee
     */
    public function setPhones(ArrayCollection $phones)
    {
        $this->phones = $phones;
        return $this;
    }

    /**
     * Add phone
     *
     * @param UserPhone $phone
     *
     * @return Employee
     */
    public function addPhone(UserPhone $phone)
    {
        $this->phones->add($phone);

        return $this;
    }

    /**
     * Remove phone
     *
     * @param UserPhone $phone
     *
     * @return Employee
     */
    public function removePhone(UserPhone $phone)
    {
        $this->phones->removeElement($phone);

        return $this;
    }
}

