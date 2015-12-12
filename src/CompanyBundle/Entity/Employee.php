<?php

namespace CompanyBundle\Entity;

use AddressBundle\Entity\EmployeeAddress;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PhoneBundle\Entity\Phone;
use PhoneBundle\Entity\UserPhone;
use UserBundle\Entity\User;

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
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="employees_groups"),
     *      joinColumns={@ORM\JoinColumn(name="employee_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     *      )
     */
    private $groups;

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
     * @var EmployeeAddress
     *
     * @ORM\OneToOne(targetEntity="AddressBundle\Entity\EmployeeAddress", mappedBy="employee")
     **/
    private $address;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AddressBundle\Entity\CompanyAddress", mappedBy="company")
     **/
    private $phones;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     **/
    private $user;

    function __construct()
    {
        $this->groups = new ArrayCollection();
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
    public function setEmploymentEnd(\DateTime $employmentEnd = null)
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
     * Get address     *
     * @return EmployeeAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param EmployeeAddress $address
     *
     * @return Employee
     */
    public function setAddress(EmployeeAddress $address)
    {
        $this->address = $address;
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

    /**
     * Get groups
     *
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set groups
     *
     * @param mixed $groups
     *
     * @return Employee
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
        return $this;
    }

    /**
     * Add group
     *
     * @param Group $group
     *
     * @return Company
     */
    public function addGroup(Group $group)
    {
        $this->groups->add($group);

        return $this;
    }

    /**
     * Remove group
     *
     * @param Group $group
     *
     * @return Company
     */
    public function removeGroup(Group $group)
    {
        $this->groups->removeElement($group);

        return $this;
    }

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
     * @return Employee
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }


}

