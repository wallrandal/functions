<?php

namespace Tests\Stack;

use App\Stack\Stack;
use PHPUnit\Framework\TestCase;
use App\Stack\BoundedStack;
use App\Stack\EmptyException;
use App\Stack\IllegalCapacityException;
use App\Stack\StackOverflowException;
use App\Stack\StackUnderflowException;

class StackTest extends TestCase
{
    private Stack $stack;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stack = BoundedStack::make(2);
        error_reporting(E_ALL);
    }

    public function testNewStackShouldBeEmpty(): void
    {
        $this->assertTrue($this->stack->isEmpty());
        $this->assertEquals(0, $this->stack->getSize());
    }

    public function testAfterOnePushStackShouldBeOne(): void
    {
        $this->stack->push(1);
        $this->assertFalse($this->stack->isEmpty());
        $this->assertEquals(1, $this->stack->getSize());
    }

    public function testAfterOnePushAndOnePopStackShouldBeZero(): void
    {
        $this->stack->push(1);
        $this->stack->pop();
        $this->assertTrue($this->stack->isEmpty());
        $this->assertEquals(0, $this->stack->getSize());
    }

    public function testWhenPushedPassedLimitStackOverflows(): void
    {
        $this->expectException(StackOverflowException::class);
        $this->stack->push(1);
        $this->stack->push(1);
        $this->stack->push(1);
    }

    public function testWhenEmptyStackIsPoppedShouldThrowStackUnderflow(): void
    {
        $this->expectException(StackUnderflowException::class);
        $this->stack->pop();
        $this->stack->pop();
        $this->stack->pop();
    }

    public function testWhenOneIsPushedOneIsPopped(): void
    {
        $this->stack->push(1);
        self::assertEquals(1, $this->stack->pop());
    }

    public function testWhenOneAndTwoArePushedOneAndTwoArePopped(): void
    {
        $this->stack->push(1);
        $this->stack->push(2);
        self::assertEquals(2, $this->stack->pop());
        self::assertEquals(1, $this->stack->pop());
    }

    public function testWhenCreatingStackWithNegativeSizeShouldThrowIllegalCapacity(): void
    {
        $this->expectException(IllegalCapacityException::class);
        BoundedStack::Make(-1);
    }

    public function testWhenCreatingStackWithZeroCapacityAnyPushShouldOverflow(): void
    {
        $this->expectException(StackOverflowException::class);
        $stack = BoundedStack::Make(0);
        $stack->push(1);
    }

    public function testWhenOneIsPushedOneIsOnTop(): void
    {
        $this->stack->push(1);
        $this->assertEquals(1, $this->stack->top());
    }

    public function testWhenStackIsEmptyShouldThrowEmpty(): void
    {
        $this->expectException(EmptyException::class);
        $this->stack->top();
    }

    public function testWheZeroCapacityStackIsEmptyShouldThrowEmpty(): void
    {
        $this->expectException(EmptyException::class);
        $stack = BoundedStack::Make(0);
        $stack->top();
    }

    public function testGivenStackWithOneTwoPushedFindOne(): void
    {
        $this->stack->push(1);
        $this->stack->push(2);
        self::assertEquals(1, $this->stack->find(1));
        self::assertEquals(0, $this->stack->find(2));
    }

    public function testGivenStackWithNoTwoFindTwoReturnNull(): void
    {
        self::assertNull($this->stack->find(2));
    }
}