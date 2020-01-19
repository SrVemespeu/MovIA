<?php

namespace App\Controller;

use App\Entity\User;
use App\Http\Request;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/api/users", methods={"GET"})
     */
    public function list()
    {
        $users = $this->userService->getUsers();
        return $this->json($users);
    }

    /**
     * @Route("/api/users", methods={"POST"})
     */
    public function create(Request $request)
    {
        $user = $this->userService->createUser($request);
        return $this->json($user, 201);
    }

    /**
     * @Route("/api/users/{id}", methods={"GET"})
     */
    public function show(User $user)
    {
        return $this->json($user);
    }

    /**
     * @Route("/api/users/{id}", methods={"PUT"})
     */
    public function update(Request $request, User $user)
    {
        $user = $this->userService->updateUser($request, $user);
        return $this->json($user);
    }

    /**
     * @Route("/api/users/{id}", methods={"DELETE"})
     */
    public function delete(User $user)
    {
        $this->userService->deleteUser($user);
        return $this->json($user);
    }
}