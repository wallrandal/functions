<?php

namespace App\Stack;

interface Stack
{
    public function isEmpty(): bool;

    public function push(int $element): void;

    public function pop(): int;

    public function getSize(): int;

    public function top(): int;

    public function find(int $element): ?int;
}