<?php


namespace App\DataFixtures;
use App\Entity\Specjalization;
use App\Entity\User;

use App\Entity\Doctor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SpecializationFixtures extends Fixture
{

    public const  REF_UROLOG ='urolog';
    public const  REF_LOGOPEDA ='logopeda';
    public const  REF_STOMATOLOG ='stomatolog';

    public function load(ObjectManager $manager)
    {
        $specjalization1 =new Specjalization();
        $specjalization1->setName('Urolog');
        $manager->persist($specjalization1);

        //dodajemy referencje zeby mozna bylo wstawic to do fixtury doctor
        $this->addReference(self::REF_UROLOG,$specjalization1);


        $specjalization2 =new Specjalization();
        $specjalization2->setName('logopeda');
        $manager->persist($specjalization2);

        $this->addReference(self::REF_LOGOPEDA,$specjalization2);

        $specjalization3 =new Specjalization();
        $specjalization3->setName('stomatolog');
        $manager->persist($specjalization3);

        $this->addReference(self::REF_STOMATOLOG,$specjalization3);

        $manager->flush();
    }


}