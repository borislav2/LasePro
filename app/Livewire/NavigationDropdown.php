<?php

namespace App\Livewire;

use Livewire\Component;

class NavigationDropdown extends Component
{
    public function render()
    {
        return view('livewire.navigation-dropdown', [
            'links' => [
                ['label' => 'Начало', 'route' => 'home', 'icon' => 'fas fa-home'],
                ['label' => 'Новини', 'route' => 'news.index', 'icon' => 'fas fa-newspaper'],
                ['label' => 'Събития', 'route' => 'events.index', 'icon' => 'fas fa-calendar-alt'],
                ['label' => 'Материали', 'route' => 'resources.index', 'icon' => 'fas fa-file-alt'],
            ],
        ]);
    }
}
