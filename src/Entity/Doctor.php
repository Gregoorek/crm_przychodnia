<?php


namespace App\Entity;


use App\Partial\IdAwareInterface;
use App\Partial\IdAwareTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Doctor
 * @package App\Entity
 * @ORM\Entity()
 */

class Doctor implements IdAwareInterface    //src/Partial/IdAwareInterface.php
{
    use IdAwareTrait;                    //src/Partial/IdAwareTrait.php

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $lastName;
                                                                        //powiazanie tabelek
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specjalization")
     * @var Specjalization
     */
    private $Specjalization;

    /**
     * @ORM\OneToMany(targetEntity='App\Entity\Visit", mappedBy="doctor")
     * @var Visit[]|Collection
     */
    private $visits;

    /**
     * @return Specjalization
     */
    public function getSpecjalization(): ?Specjalization
    {
        return $this->Specjalization;
    }

    /**
     * @param Specjalization $Specjalization
     */
    public function setSpecjalization(Specjalization $Specjalization): void
    {
        $this->Specjalization = $Specjalization;
    }


    //teraz gettery i settery


    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return Visit[]|Collection
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * @param Visit[]|Collection $visits
     */
    public function setVisits($visits): void
    {
        $this->visits = $visits;
    }

    public function __toString():string
    {
        return $this->firstName.' '.$this->lastName.' - '.$this->Specjalization->getName();
    }
}