<?php

namespace App\Tests\Service;

use App\Service\LimitChecker;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LimitCheckerTest extends KernelTestCase {
    private LimitChecker $limitChecker;

    // public function testIsLimitReached() {
    //     $this->limitChecker->getRemainingSpots();
    //     $this->assertTrue($this->limitChecker->isLimitReached());
    // }
}