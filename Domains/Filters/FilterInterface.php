<?php
namespace BitPanda\Filters;

interface FilterInterface
{
    public function handle($value): void;
}
