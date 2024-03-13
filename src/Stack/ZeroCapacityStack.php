<?php

namespace App\Stack;
class ZeroCapacityStack implements Stack
{

    public function isEmpty(): bool
    {
        return true;
    }

    public function getSize(): int
    {
        return 0;
    }

    public function push(int $element): void
    {
        throw new StackOverflowException();
    }

    public function pop(): int
    {
        throw new StackOverflowException();
    }

    public function top(): int
    {
        throw new EmptyException();
    }

    public function find(int $element): ?int
    {
        return -1;
    }
}