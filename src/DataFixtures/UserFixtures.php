<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setFirstname('Théo')
            ->setLastname('Gamory')
            ->setEmail('boostmacom@gmail.com')
            ->setBirthAt(new \DateTime())
            ->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'azerty'
            ))
            ->setRoles(['ROLE_ADMIN'])
            ->setIsValidate(true)
        ;

        $manager->persist($user);
        $manager->flush();
    }
}
