<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Validation\Rule;

class AuthenticateController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
    }
}
