<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Partage $unreadCount dans toutes les vues
        View::composer('*', function ($view) {
            $unreadCount = 0;

            // Vérifie si un utilisateur est connecté
            if (Auth::check()) {
                $unreadCount = Notification::where('user_id', Auth::id())
                                           ->whereNull('read_at')
                                           ->count();
            }

            // Ajoute $unreadCount à toutes les vues
            $view->with('unreadCount', $unreadCount);
        });
    }
}
