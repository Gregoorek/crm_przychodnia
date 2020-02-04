<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;
                                                            //funkcja do wstrzykiwania hasla do load
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user =new User();
        $user->setRoles(['ROLE_ADMIN']);
        $user->setEmail('admin@admin.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'pass'));
        $manager->persist($user);
        $manager->flush();
    }
}
