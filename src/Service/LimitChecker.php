<?php

namespace App\Service;

use App\Repository\UserRepository;

class LimitChecker
{
    private const MAX_USERS = 100;
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function isLimitReached(): bool {
        return $this->getRemainingSpots() <= 0;
    }

    public function getRemainingSpots(): int {
        $userCount = $this->userRepository->count([]);
        return max(0, self::MAX_USERS - $userCount);
    }
}