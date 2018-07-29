<?php

/**
 * Little wrapper for factory's create() method. It saves it in BD.
 *
 * @param $class. Model name
 * @param array $attributes
 * @param int $times. If specified, it will returns Collection of models, if not, it will return just a Model instance
 * @return mixed | \Illuminate\Database\Eloquent\Collection
 */
function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

/**
 * Little wrapper for factory's make() method. Records won't be saved in BD.
 *
 * @param $class. Model name
 * @param array $attributes
 * @param int $times. If specified, it will returns Collection of models, if not, it will return just a Model instance
 * @return mixed | \Illuminate\Database\Eloquent\Collection
 */
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

/**
 * Helper that returns an ID of a specified Model (by class name).
 * If there are any Model, it will grab one randomly, if not, it will create a new one using it's Factory
 *
 * @param string $model
 * @param array $attributes
 * @return int
 */
function associateTo($model, $attributes = [])
{
    $model = app()->make($model);

    return $model::count() > 0
        ? $model::all()->random()->id
        : factory(get_class($model))->create($attributes)->id; // call to Factory
}
