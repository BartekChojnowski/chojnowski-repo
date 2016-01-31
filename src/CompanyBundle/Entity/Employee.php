<?php

namespace CompanyBundle\Entity;

use AddressBundle\Entity\EmployeeAddress;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PhoneBundle\Entity\Phone;
use PhoneBundle\Entity\UserPhone;
use UserBundle\Entity\User;

/**
 * Klasa reprezentująca pracownika
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class Employee
{
    /**
     * @var integer Identyfikator
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string Imię
     *
     * @ORM\Column(name="firstName", type="string", length=60)
     */
    private $firstName;

    /**
     * @var string Nazwisko
     *
     * @ORM\Column(name="lastName", type="string", length=60)
     */
    private $lastName;

    /**
     * @var string Pesel
     *
     * @ORM\Column(name="personalId", type="string", length=11)
     */
    private $personalId;

    /**
     * @var \DateTime Data urodzenia
     *
     * @ORM\Column(name="dateOfBirth", type="datetime")
     */
    private $dateOfBirth;

    /**
     * @var Company Firma, do której pracownik jest przypisany
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

    /**
     * @var ArrayCollection Grupy, do których pracownik jest przypisany
     *
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="employees_groups"),
     *      joinColumns={@ORM\JoinColumn(name="employee_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     *      )
     */
    private $groups;

    /**
     * Status pracownika
     *
     * @ORM\ManyToOne(targetEntity="EmployeeStatus")
     * @ORM\JoinColumn(name="status", referencedColumnName="id")
     */
    private $status;

    /**
     * @var \DateTime Data rozpoczęcia pracy
     *
     * @ORM\Column(name="employmentStart", type="datetime")
     */
    private $employmentStart;

    /**
     * @var \DateTime Data zakończenia pracy
     *
     * @ORM\Column(name="employmentEnd", type="datetime", nullable=true)
     */
    private $employmentEnd;

    /**
     * @var EmployeeAddress Adres
     *
     * @ORM\OneToOne(targetEntity="AddressBundle\Entity\EmployeeAddress", mappedBy="employee")
     **/
    private $address;

    /**
     * @var ArrayCollection Numery telefonów
     *
     * @ORM\OneToMany(targetEntity="AddressBundle\Entity\CompanyAddress", mappedBy="company")
     **/
    private $phones;

    /**
     * @var User Konto pracownika w systemie
     *
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     **/
    private $user;

    /**
     * Konstruktor
     */
    function __construct()
    {
        $this->groups = new ArrayCollection();
    }


    /**
     * Metoda zwraca identyfikator
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Metoda ustawia imię
     *
     * @param string $firstName Imię
     *
     * @return Employee
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Metoda zwraca nazwisko
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Metoda ustawia nazwisko
     *
     * @param string $lastName Nazwisko
     *
     * @return Employee
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Metoda zwraca nazwisko
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Metoda ustawia pesel
     *
     * @param string $personalId Pesel
     *
     * @return Employee
     */
    public function setPersonalId($personalId)
    {
        $this->personalId = $personalId;

        return $this;
    }

    /**
     * Metoda zwraca pesel
     *
     * @return string
     */
    public function getPersonalId()
    {
        return $this->personalId;
    }

    /**
     * Metoda zwraca datę urodzenia
     *
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Metoda ustawia datę urodzenia
     *
     * @param string $dateOfBirth Data urodzenia
     *
     * @return Employee
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Metoda ustawia status
     *
     * @param EmployeeStatus $status Status
     *
     * @return Employee
     */
    public function setStatus(EmployeeStatus $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Metoda zwraca status
     *
     * @return EmployeeStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Metoda ustawia datę rozpoczęcia pracy
     *
     * @param \DateTime $employmentStart Data rozpoczęcia pracy
     *
     * @return employee
     */
    public function setEmploymentStart(\DateTime $employmentStart)
    {
        $this->employmentStart = $employmentStart;

        return $this;
    }

    /**
     * Metoda zwraca datę rozpoczęcia pracy
     *
     * @return \DateTime
     */
    public function getEmploymentStart()
    {
        return $this->employmentStart;
    }

    /**
     * Metoda ustawia datę zakończenia pracy
     *
     * @param \DateTime $employmentEnd Data zakończenia pracy
     *
     * @return Employee
     */
    public function setEmploymentEnd(\DateTime $employmentEnd = null)
    {
        $this->employmentEnd = $employmentEnd;

        return $this;
    }

    /**
     * Metoda zwraca datę zakończenia pracy
     *
     * @return \DateTime
     */
    public function getEmploymentEnd()
    {
        return $this->employmentEnd;
    }

    /**
     * Metoda zwraca adres     *
     *
     * @return EmployeeAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Metoda ustawia adres
     *
     * @param EmployeeAddress $address Adres
     *
     * @return Employee
     */
    public function setAddress(EmployeeAddress $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Metoda zwraca kolekcję telefonów
     *
     * @return ArrayCollection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Metoda ustawia kolekcję telefonów
     *
     * @param ArrayCollection $phones Telefony
     *
     * @return Employee
     */
    public function setPhones(ArrayCollection $phones)
    {
        $this->phones = $phones;
        return $this;
    }

    /**
     * Metoda dodaje telefon do kolekcji
     *
     * @param UserPhone $phone Telefon
     *
     * @return Employee
     */
    public function addPhone(UserPhone $phone)
    {
        $this->phones->add($phone);

        return $this;
    }

    /**
     * Metoda usuwa telefon z kolekcji
     *
     * @param UserPhone $phone Telefon
     *
     * @return Employee
     */
    public function removePhone(UserPhone $phone)
    {
        $this->phones->removeElement($phone);

        return $this;
    }

    /**
     * Metoda zwraca grupy, do których pracownik jest przypisany
     *
     * @return ArrayCollection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Metoda ustawia grupy, do których pracownik jest przypisany
     *
     * @param ArrayCollection $groups Kolekcja grup
     *
     * @return Employee
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
        return $this;
    }

    /**
     * Metoda dodaje grupę do kolekcji
     *
     * @param Group $group Grupa
     *
     * @return Company
     */
    public function addGroup(Group $group)
    {
        $this->groups->add($group);

        return $this;
    }

    /**
     * Metoda usuwa grupę z kolekcji
     *
     * @param Group $group Grupa
     *
     * @return Company
     */
    public function removeGroup(Group $group)
    {
        $this->groups->removeElement($group);

        return $this;
    }

    /**
     * Metoda zwraca konto pracownika w systemie
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Metoda ustawia konto pracownika w systemie
     *
     * @param User $user Konto pracownika
     *
     * @return Employee
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Metoda imię i nazwisko pracownika
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->getLastName().' '.$this->getFirstName();
    }

    /**
     * Metoda zwraca firmę, do której pracownik jest przypisany
     *
     * @return Company Firma
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Metoda ustawia firmę, do której pracownik jest przypisany
     *
     * @param Company $company
     *
     * @return CompanyFreight
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
        return $this;
    }

}

