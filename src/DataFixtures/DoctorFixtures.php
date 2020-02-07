<?php


namespace App\DataFixtures;
use App\Entity\Specjalization;
use App\Entity\User;

use App\Entity\Doctor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DoctorFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;
    //funkcja do wstrzykiwania hasla do load
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $doctor1 =new Doctor();
        $doctor1->setRoles(['ROLE_USER', 'ROLE_DOCTOR']);
        $doctor1->setPassword($this->passwordEncoder->encodePassword($doctor1,'pass'));
        $doctor1->setLastName('aneta');
        $doctor1->setFirstName('Augustyn');
        $doctor1->setEmail('aneta@doktor.com');
        //odczytanie referencji z fic specjalization
        $doctor1->setSpecjalization($this->getReference(SpecializationFixtures::REF_UROLOG));
        $manager->persist($doctor1);

        $doctor2 =new Doctor();
        $doctor2->setRoles(['ROLE_USER', 'ROLE_DOCTOR']);
        $doctor2->setPassword($this->passwordEncoder->encodePassword($doctor2,'pass'));
        $doctor2->setLastName('zosia');
        $doctor2->setFirstName('Augustyn');
        $doctor2->setEmail('zosia@doktor.com');
        //odczytanie referencji z fic specjalization
        $doctor2->setSpecjalization($this->getReference(SpecializationFixtures::REF_STOMATOLOG));
        $manager->persist($doctor2);

        $doctor3 =new Doctor();
        $doctor3->setRoles(['ROLE_USER', 'ROLE_DOCTOR']);
        $doctor3->setPassword($this->passwordEncoder->encodePassword($doctor3,'pass'));
        $doctor3->setLastName('monika');
        $doctor3->setFirstName('Augustyn');
        $doctor3->setEmail('monika@doktor.com');
        //odczytanie referencji z fic specjalization
        $doctor3->setSpecjalization($this->getReference(SpecializationFixtures::REF_LOGOPEDA));
        $manager->persist($doctor3);

        $doctor4 =new Doctor();
        $doctor4->setRoles(['ROLE_USER', 'ROLE_DOCTOR']);
        $doctor4->setPassword($this->passwordEncoder->encodePassword($doctor4,'pass'));
        $doctor4->setLastName('genowefa');
        $doctor4->setFirstName('Augustyn');
        $doctor4->setEmail('genowefa@doktor.com');
        //odczytanie referencji z fic specjalization
        $doctor4->setSpecjalization($this->getReference(SpecializationFixtures::REF_STOMATOLOG));
        $manager->persist($doctor4);

        $manager->flush();
    }
//zwaracmy foxtury ktore musza byc wykonane przed fix doktor
    public function getDependencies()
    {
        return [SpecializationFixtures::class];
    }


}