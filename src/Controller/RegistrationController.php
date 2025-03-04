<?php

namespace App\Controller;

use App\Dto\Authorization\RegistrationDto;
use App\Entity\User;
use App\Exception\UserAlreadyExistsException;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    public function __construct(
        public UserRepository $userRepository
    )
    {
    }

    #[Route('/sign-up', name: 'app_sign_up', methods: ['POST'])]
    public function signUp(#[MapRequestPayload] RegistrationDto $dto, UserPasswordHasherInterface $userPasswordHasher): JsonResponse
    {
        if ($this->userRepository->existsByUsername($dto->username)) {
            throw new UserAlreadyExistsException();
        }
        $user = new User();
        $user->setUsername($dto->username);
        $user->setPassword($userPasswordHasher->hashPassword($user, $dto->password));
        $user->setRoles(['ROLE_USER']);
        $this->userRepository->save($user);
        return $this->json(true);
    }
}
