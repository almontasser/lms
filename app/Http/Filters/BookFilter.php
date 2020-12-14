<?php


namespace App\Http\Filters;


class BookFilter extends Filter
{
    public function field(string $value = null)
    {
        return $this->builder->where('field_id', $value);
    }
}
