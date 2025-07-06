<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegistrationService
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function register(string $email, string $plainPassword, string $type): User
    {
        // Busca tipo de usuário no banco (case insensitive)
        $userType = $this->em->getRepository(UserType::class)
            ->findOneBy(['type' => strtolower($type)]);

            // dd($userType);
        if (!$userType) {
            throw new \InvalidArgumentException("Invalid user type: $type");
        }

        if ($this->em->getRepository(User::class)->findOneBy(['email' => $email])) {
            throw new \RuntimeException('User already exists.');
        }

        $user = new User();
        $user->setEmail($email);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $plainPassword)
        );
        $user->setUserType($userType); // associa a entidade UserType

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
