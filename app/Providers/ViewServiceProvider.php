<?php

namespace App\Providers;

use App\View\Composers\LoggedUser;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['layouts.navigation', 'lecturer.dashboard'], LoggedUser::class);
    }
}
