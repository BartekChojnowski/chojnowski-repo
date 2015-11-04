<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * employee
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class employee
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
     * @var string
     *
     * @ORM\Column(name="dateOfBirth", type="datetime")
     */
    private $dateOfBirth;


    /**
     * @ManyToOne(targetEntity="Position")
     * @JoinColumn(name="position", referencedColumnName="id")
     */
    private $position;

    /**
     * @ManyToOne(targetEntity="EmployeeStatus")
     * @JoinColumn(name="status", referencedColumnName="id")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="employmentStart", type="datetime")
     */
    private $employmentStart;

    /**
     * @var string
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
     * @return employee
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
     * @return employee
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
     * @return employee
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
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return employee
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return employee
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set employmentStart
     *
     * @param string $employmentStart
     *
     * @return employee
     */
    public function setEmploymentStart($employmentStart)
    {
        $this->employmentStart = $employmentStart;

        return $this;
    }

    /**
     * Get employmentStart
     *
     * @return string
     */
    public function getEmploymentStart()
    {
        return $this->employmentStart;
    }

    /**
     * Set employmentEnd
     *
     * @param string $employmentEnd
     *
     * @return employee
     */
    public function setEmploymentEnd($employmentEnd)
    {
        $this->employmentEnd = $employmentEnd;

        return $this;
    }

    /**
     * Get employmentEnd
     *
     * @return string
     */
    public function getEmploymentEnd()
    {
        return $this->employmentEnd;
    }
}

