<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        return $this->indexResponse(RoleResource::collection(Role::all()));
    }
}
