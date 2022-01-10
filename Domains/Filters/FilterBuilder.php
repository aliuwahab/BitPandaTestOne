<?php

namespace BitPanda\Filters;

use BitPanda\Exceptions\NotAValidFilterKeyException;
use Illuminate\Database\Eloquent\Builder;

class FilterBuilder
{
    private Builder $query;
    private array $filters;
    private string $namespace;

    public function __construct(Builder $query, array $filters, string $namespace)
    {
        $this->query = $query;
        $this->filters = $filters;
        $this->namespace = $namespace;
    }


    public function apply(): Builder
    {
        foreach ($this->filters as $name => $value) {
            $normalizedName = ucfirst($name);
            $class = $this->namespace . "\\{$normalizedName}";

            if (!class_exists($class)) {
                throw new NotAValidFilterKeyException('Not a valid filter key for: '.$name);
            }

            if (is_array($value) && count($value) > 0) {
                (new $class($this->query))->handle($value);
            }elseif(is_string($value) && strlen($value)) {
                (new $class($this->query))->handle($value);
            } else {
                (new $class($this->query))->handle();
            }
        }

        return $this->query;
    }

}
