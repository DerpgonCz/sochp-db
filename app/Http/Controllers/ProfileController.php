<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController
{
    public function index(): View
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }
}
