<?php


namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Patient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PatientFixtures extends Fixture
{
    private $passwordEncoder;
    //funkcja do wstrzykiwania hasla do load
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $patient =new Patient();
        $patient->setRoles(['ROLE_USER', 'ROLE_PATIENT']);
        $patient->setEmail('patient@patient.com');
        $patient->setPassword($this->passwordEncoder->encodePassword($patient,'pass'));
        $patient->setLastName('Jan');
        $patient->setFirstName('Kowalski');
        $manager->persist($patient);
        $manager->flush();
    }


}