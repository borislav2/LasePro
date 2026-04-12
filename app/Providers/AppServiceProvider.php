<?php

namespace App\Providers;

use Filament\Facades\Filament;
use App\Livewire\NavigationDropdown;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Providers\Filament\StudentPanelProvider;
use App\Providers\Filament\TeacherPanelProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::registerRenderHook(
            'panels::global-search.after',
            fn (): string => Blade::render('@livewire("navigation-dropdown")')
        );
    
        \Livewire::component('navigation-dropdown', NavigationDropdown::class);
    }
}
