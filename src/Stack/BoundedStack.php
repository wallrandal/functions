<?php

class BoundedStack implements Stack
{
    private int $size = 0;
    private int $capacity;

    private array $elements = [];

    private function __construct(int $capacity)
    {
        $this->capacity = $capacity;
        $this->elements = [$this->capacity];
    }

    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function push(int $element): void
    {
        if ($this->size === $this->capacity) {
            throw new StackOverflowException();
        }

        $this->elements[$this->size++] = $element;
    }

    public function pop(): int
    {
        if ($this->size === 0) {
            throw new StackUnderflowException();
        }

        return $this->elements[--$this->size];
    }

    public function top(): int
    {
        if ($this->size === 0) {
            throw new EmptyException();
        }
        return $this->elements[$this->size - 1];
    }

    public static function make(int $capacity): Stack
    {
        if ($capacity < 0) {
            throw new IllegalCapacityException();
        }

        if ($capacity === 0) {
            return new ZeroCapacityStack();
        }
        return new BoundedStack($capacity);
    }

    public function find(int $element): ?int
    {
        for ($i = $this->size - 1; $i >= 0; $i--) {
            if ($this->elements[$i] === $element) {
                return ($this->size - 1) - $i;
            }
        }
        return null;
    }
}