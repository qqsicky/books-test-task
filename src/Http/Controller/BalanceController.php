<?php

namespace App\Http\Controller;

use App\Application\Service\Balance\UserBalanceServiceInterface;
use App\Domain\Entity\User\UserRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BalanceController extends AbstractController
{
    /**
     * @todo Тут стоит принимать json, парсить и резолвить в аргументы готовые структуры данных/DTO
     * @Route("/balance/transfer/{senderId}/{receiverId}/{amount}", methods={"POST"})
     * @param UserBalanceServiceInterface $userBalanceService
     * @param UserRepositoryInterface $userRepository
     * @param string $senderId
     * @param string $receiverId
     * @param int $amount
     * @return JsonResponse
     */
    public function transferBalance(
        UserBalanceServiceInterface $userBalanceService,
        UserRepositoryInterface $userRepository,
        string $senderId,
        string $receiverId,
        int $amount
    ): JsonResponse {
        $sender = $userRepository->find(Uuid::fromString($senderId));
        $receiver = $userRepository->find(Uuid::fromString($receiverId));

        $userBalanceService->transferBalance($sender, $receiver, $amount);

        return new JsonResponse(['result' => 'success']);
    }
}