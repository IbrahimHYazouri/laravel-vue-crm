<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Users');
    }
}
