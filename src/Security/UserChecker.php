<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) 
        
        {
            return;
        }
    }

     

    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof User)
         {
            return;
        }

        // Si l'utilisateur qui essaie de se connecter n'a pas verifier son compte
        if ( ! $user->isIsVerified())

        //c'est mort 
        //levons une exception (erreur) accompagné d'un message afin de lui expliquer le probleme
         {
            throw new CustomUserMessageAccountStatusException('Veuillez confimer votre compte par email avant de vous connecter');
        }
    }
}