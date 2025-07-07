<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\ActivityService;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void
    {
        // Log logout before actually logging out
        ActivityService::logout();

        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
    }
}
