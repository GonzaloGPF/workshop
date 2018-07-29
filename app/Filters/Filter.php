<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var array. Array of table attributes to use for filter models
     */
    protected $filters = [];

    /**
     * Filter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * It returns an array containing all key-values of a request based on $filter property of a Model
     * Every 'key' ($filter) MUST MATCH with the correct method name of the Model class
     *
     * @return array
     */
    public function getFilters()
    {
        // removes all NULL and Empty Strings but leaves 0 (zero) and false values
        return array_filter($this->request->only($this->filters), function ($value) {
            if (is_null($value) || $value === '') {
                return false;
            }

            return true;
        });
    }

    /**
     * @param Builder $builder
     * @return Builder|Request
     */
    public function filter(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            $filter = underscoreToCamelCase($filter);

            if (method_exists($this, $filter)) {
                $this->$filter($value);
            } else {
                logger("Can't filter. Attribute [$filter] is not present in '\$filters' array");
            }
        }

        return $this->builder;
    }

    /**
     * Orders by a 'sort' string if it's present in request
     * This sort string must be with the format 'attribute|orderDirection'
     * for example: a string 'name|asc' means: ordering by 'name' in 'ascending' order
     *
     * @param Builder $builder
     * @return Builder
     */
    public function order(Builder $builder)
    {
        $sortString = $this->request->get('sort');

        if ($sortString && strpos($sortString, '|') !== false) {
            $this->builder = $builder;
            $this->builder->getQuery()->orders = [];

            list($attribute, $order) = explode('|', $sortString);

            if (in_array($attribute, $this->filters)) {
                $this->builder->orderBy($attribute, $order);
            } else {
                logger("Can't order. Attribute [$attribute] is not present in '\$filters' array");
            }
        } else {
            $builder->latest();
        }

        return $this->builder;
    }

    /**
     * Executes the query builder to get data from database.
     * It will look for a 'with' input in request body. If exits, it will eager load relations
     * If a 'per_page' input is detected, it will be paginated.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function getOrPaginate()
    {
        if ($relations = $this->request->get('with')) {
            $this->loadRelations($relations);
        }

        $perPage = $this->request->get('per_page');

        return $perPage
            ? $this->builder->paginate($perPage)
            : $this->builder->get();
    }

    /**
     * The $relations param can be an array or a string, specifying relations that must be eager loaded
     * The value of $relations will be changed from under_score_case to camelCase
     *
     * @param array|string $relations
     * @return Builder
     */
    private function loadRelations($relations)
    {
        if (is_array($relations)) {
            collect($relations)->each(function ($relation) {
                $this->builder->with(underscoreToCamelCase($relation));
            });
        } else {
            $this->builder->with(underscoreToCamelCase($relations));
        }

        return $this->builder;
    }
}
