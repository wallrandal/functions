<?php

namespace App\Lychrel;

class Lychrel
{

    public function __construct()
    {
    }

    public function convergesAtIteration(int $n, int $limit): int
    {
        $iteration = 0;
        return $this->converge($n, $iteration);
    }

    /**
     * @param int $n
     * @return bool
     */
    public function isPalindrome(int $n): bool
    {
        $digits = (string)$n;

        $lastIndex = strlen($digits) - 1;

        for ($i = 0; $i < strlen($digits); $i++) {
            if (substr($digits, $i, 1) !== substr($digits, $lastIndex - $i, 1)) {
                return false;
            }
        }
        return true;
    }

    public function reverse(int $n): int
    {
        $digits = (string)$n;
        $reverse = strrev($digits);
        return (int)$reverse;
    }

    /**
     * @param int $n
     * @param int $iteration
     * @return int
     */
    public function converge(int $n, int $iteration): int
    {
        if (!$this->isPalindrome($n)) {
            return $this->converge($n + $this->reverse($n), $iteration + 1);
        }
        return $iteration;
    }
}