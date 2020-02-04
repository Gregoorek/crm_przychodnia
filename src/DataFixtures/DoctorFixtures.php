<?php


namespace App\DataFixtures;
use App\Entity\User;

use App\Entity\Doctor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DoctorFixtures extends Fixture
{
    private $passwordEncoder;
    //funkcja do wstrzykiwania hasla do load
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $doctor =new Doctor();
        $doctor->setRoles(['ROLE_USER', 'ROLE_DOCTOR']);
        $doctor->setPassword($this->passwordEncoder->encodePassword($doctor,'pass'));
        $doctor->setLastName('Monika');
        $doctor->setFirstName('Augustyn');
        $doctor->setEmail('doktor@doktor.com');
        $manager->persist($doctor);
        $manager->flush();
    }


}