<?php

namespace App\Http\Controllers;

use App\Models\ServiceCase;
use Exception;
use App\Models\Customer;
use Illuminate\Validation\Rule;

class AuthenticateController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }
}
