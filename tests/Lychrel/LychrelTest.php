<?php

namespace Tests\Lychrel;

use PHPUnit\Framework\TestCase;
use App\Lychrel\Lychrel;

class LychrelTest extends TestCase
{
    private int $limit = 1000;
    private Lychrel $lychrel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->lychrel = new Lychrel();
    }

    public function testFacts(): void
    {
        $this->convergesAtIteration(1, 0);
        $this->convergesAtIteration(2, 0);
        $this->convergesAtIteration(10, 1);
        $this->convergesAtIteration(11, 0);
        $this->convergesAtIteration(19, 2);
        $this->convergesAtIteration(78, 4);
        $this->convergesAtIteration(89, 24);
        $this->doesNotConverge(196);
    }

    private function convergesAtIteration(int $n, int $iteration): void
    {
        self::assertEquals($iteration, $this->lychrel->convergesAtIteration($n, $this->limit));
    }

    public function testPalindromes(): void
    {
        $this->isPalindrome(1);
        $this->isPalindrome(11);
        $this->isPalindrome(121);
        $this->isPalindrome(12321);
        $this->isPalindrome(1234321);
    }

    public function testNotPalindromes(): void
    {
        $this->isNotPalindrome(10);
        $this->isNotPalindrome(12331);
        $this->isNotPalindrome(12443321);
    }

    private function isPalindrome(int $int): void
    {
        self::assertTrue($this->lychrel->isPalindrome(gmp_abs($int)));
    }

    private function isNotPalindrome(int $int): void
    {
        self::assertFalse($this->lychrel->isPalindrome(gmp_abs($int)));
    }

    public function testReversals(): void
    {
        $this->reversed(12, 21);
        $this->reversed(123, 321);
        $this->reversed(1, 1);
        $this->reversed(1234, 4321);
    }

    private function reversed(int $n, int $r): void
    {
        self::assertEquals($r, $this->lychrel->reverse(gmp_abs($n)));
    }

    private function doesNotConverge(int $n): void
    {
        $this->convergesAtIteration($n, $this->limit);
    }
}