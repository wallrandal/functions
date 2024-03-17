<?php

namespace Tests\BowlingGame;

use App\BowlingGame\Game;
use PHPUnit\Framework\TestCase;

class BowlingTest extends TestCase
{
    protected Game $game;

    /**
     * @return void
     */
    public function rollSpare(): void
    {
        $this->game->roll(5);
        $this->game->roll(5);
    }

    /**
     * @return void
     */
    public function rollStrike(): void
    {
        $this->game->roll(10);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->game = new Game();
    }


    private function rollMany(int $n, int $pins): void
    {
        for ($i = 0; $i < $n; $i++) {
            $this->game->roll($pins);
        }
    }

    public function testRollGutterGame(): void
    {
        $this->rollMany(0, 20);

        self::assertEquals(0, $this->game->score());
    }

    public function testAllOnes(): void
    {
        $this->rollMany(20, 1);

        self::assertEquals(20, $this->game->score());
    }

    public function testOneSpare(): void
    {
        $this->rollSpare();
        $this->game->roll(3);

        $this->rollMany(17, 0);

        self::assertEquals(16, $this->game->score());
    }


    public function testOneStrike(): void
    {
        $this->rollStrike();
        $this->game->roll(3);
        $this->game->roll(4);

        $this->rollMany(16, 0);

        self::assertEquals(24, $this->game->score());
    }

    public function testPerfectGame(): void
    {
        $this->rollMany(12, 10);

        self::assertEquals(300, $this->game->score());
    }

}