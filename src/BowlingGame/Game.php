<?php

namespace App\BowlingGame;

class Game
{
    private array $rolls;
    private int $currentRoll = 0;

    public function __construct()
    {
        $this->rolls = array_fill(0, 20, 0);
    }

    public function roll(int $pins): void
    {
        $this->rolls[$this->currentRoll++] = $pins;
    }

    public function score(): int
    {
        $score = 0;
        $firstInFrame = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($firstInFrame)) {
                $score += $this->nextTwoBallsInStrike($firstInFrame);
                $firstInFrame++;
            } elseif ($this->isSpare($firstInFrame)) {
                $score += 10 + $this->nextBallForSpare($firstInFrame);
                $firstInFrame += 2;
            } else {
                $score += $this->twoBallsInFrame($firstInFrame);
                $firstInFrame += 2;
            }
        }

        return $score;
    }

    /**
     * @param int $firstInFrame
     * @return mixed
     */
    public function isSpare(int $firstInFrame): bool
    {
        return $this->twoBallsInFrame($firstInFrame) === 10;
    }

    /**
     * @param int $firstInFrame
     * @return bool
     */
    public function isStrike(int $firstInFrame): bool
    {
        return $this->rolls[$firstInFrame] == 10;
    }

    /**
     * @param int $firstInFrame
     * @return int|mixed
     */
    public function nextTwoBallsInStrike(int $firstInFrame): mixed
    {
        return 10 + $this->rolls[$firstInFrame + 1] + $this->nextBallForSpare($firstInFrame);
    }

    /**
     * @param int $firstInFrame
     * @return mixed
     */
    public function nextBallForSpare(int $firstInFrame): mixed
    {
        return $this->rolls[$firstInFrame + 2];
    }

    /**
     * @param int $firstInFrame
     * @return mixed
     */
    public function twoBallsInFrame(int $firstInFrame): mixed
    {
        return $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1];
    }
}