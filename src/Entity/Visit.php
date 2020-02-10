<?php


namespace App\Entity;

use App\Partial\IdAwareInterface;
use App\Partial\IdAwareTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Visit
 * @package App\Entity
 * @UniqueEntity(fields={"startDate", "doctor"}, message="Termin juz zarezerwowany. Prosze ustalić wizyte w innym terminie.")
 * @ORM\Entity()
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(columns={"start_Date", "doctor_id" })})
 */
class Visit implements IdAwareInterface
{
    use IdAwareTrait;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Doctor")
     * @var Doctor
     */
    private $doctor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient")
     * @var Patient
     */
    private $patient;


    /**
     * @return \DateTime
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    /**
     * @return Doctor
     */
    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    /**
     * @return Patient
     */
    public function getPatient(): ?Patient
    {
        return $this->patient;
    }


    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @param Doctor $doctor
     */
    public function setDoctor(Doctor $doctor): void
    {
        $this->doctor = $doctor;
    }

    /**
     * @param Patient $patient
     */
    public function setPatient(Patient $patient): void
    {
        $this->patient = $patient;
    }

    public function __toString()
    {
        return $this->startDate->format('Y-m-d h:i').' '.$this->endDate->format('Y-m-d h:i').' '.$this->patient->__toString();
    }




}