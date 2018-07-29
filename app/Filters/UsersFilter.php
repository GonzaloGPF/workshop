<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class UsersFilter extends Filter
{
    /**
     * @var array. Applicable filters by request's query strings. Every filter will be use by Filter class.
     * Filter class will look for a method with the same name of the filter.
     */
    protected $filters = ['name', 'email', 'role_id'];

    /**
     * @param string $name
     * @return Builder
     */
    protected function name($name)
    {
        return $this->builder->where('name', 'like', "%$name%");
    }

    /**
     * @param string $email
     * @return Builder
     */
    protected function email($email)
    {
        return $this->builder->where('email', 'like', "%$email%");
    }

    /**
     * @param $id
     * @return Builder
     */
    protected function roleId($id)
    {
        return $this->builder->where('role_id', $id);
    }
}
