<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SuperAdminFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    
    public function load(ObjectManager $manager): void
    {
        $superAdmin= $this->createSuperAdmin();
        $manager->persist($superAdmin);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
     private function createSuperAdmin (): User

     {
        $superAdmin = new User();

        $superAdmin->setFirstName ("Cécilia");
        $superAdmin->setLastName ("Martial");
        $superAdmin->setEmail ("cecilia@patatas.com");
        $superAdmin->setRoles (["ROLE_SUPER_ADMIN","ROLE_ADMIN", "ROLE_USER"]);
        
        $passwordHashed= $this->hasher->hashPassword($superAdmin,"azerty1234a*");
        $superAdmin->setPassword ($passwordHashed);

        $superAdmin->setIsVerified(true);

        $superAdmin->setCreatedAt (new \DateTimeImmutable());
        $superAdmin->setVerifiedAt (new \DateTimeImmutable());
        $superAdmin->setUpdatedAt (new \DateTimeImmutable());

        return $superAdmin;

     }
}
