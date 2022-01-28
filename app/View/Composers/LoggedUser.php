<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoggedUser
{
    public function compose(View $view): void
    {
        $view->with('user', Auth::user());
    }
}
