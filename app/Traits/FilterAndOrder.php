<?php

namespace App\Traits;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

trait FilterAndOrder
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * Applies filter() from @see Filter
     *
     * @param Builder $query
     * @param $filter
     * @return mixed
     */
    public function scopeFilter(Builder $query, Filter $filter)
    {
        $this->filter = $filter;

        return $filter->filter($query);
    }

    /**
     * Applies order() from @see Filter
     *
     * @param Builder $query
     * @param $filter
     * @return mixed
     */
    public function scopeOrder(Builder $query, Filter $filter)
    {
        $this->filter = $filter;

        return $filter->order($query);
    }

    /**
     * Applies getOrPaginate() from @see Filter
     *
     * @param Builder $query
     * @throws \Exception
     * @return mixed
     */
    public function scopeGetOrPaginate(Builder $query)
    {
        if (! $this->filter) {
            throw new \Exception("No filter available to apply getOrPaginate()");
        }

        return $this->filter->getOrPaginate();
    }
}
