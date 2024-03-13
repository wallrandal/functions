<?php

namespace App\Lychrel;

use GMP;

class Lychrel
{

    public function __construct()
    {
    }

    public function convergesAtIteration(int $n, int $limit): int
    {
        $iteration = 0;
        return $this->converge(gmp_abs($n), $iteration, $limit);
    }

    /**
     * @param GMP $n
     * @return bool
     */
    public function isPalindrome(GMP $n): bool
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

    public function reverse(\GMP $n): int
    {
        $digits = (string)$n;
        $reverse = strrev($digits);
        return (int)$reverse;
    }

    /**
     * @param GMP $n
     * @param int $iteration
     * @return int
     */
    public function converge(GMP $n, int $iteration, int $limit): int
    {
        if (!$this->isPalindrome($n) && $iteration < $limit) {
            return $this->converge($n + $this->reverse($n), $iteration + 1, $limit);
        }
        return $iteration;
    }
}