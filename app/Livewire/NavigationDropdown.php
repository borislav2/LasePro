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
                ['label' => 'Галерия', 'route' => 'gallery', 'icon' => 'fas fa-images'],
            ],
        ]);
    }
}
