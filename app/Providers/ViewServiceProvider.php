<?php

namespace App\Providers;

use App\View\Composers\LoggedUser;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    protected array $sharedLoggedUserViews = [
        'layouts.app',
        'layouts.navigation',
        'lecturer.dashboard',
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer($this->sharedLoggedUserViews, LoggedUser::class);
    }
}
