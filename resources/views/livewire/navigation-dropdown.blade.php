{{-- filepath: c:\xampp\htdocs\btu-marketing\resources\views\livewire\navigation-dropdown.blade.php --}}
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" style="background-color:rgb(131, 97, 3); color: white; padding: 1rem 1.5rem; border-radius: 0.375rem; border: none; cursor: pointer; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgb(119, 88, 3)'" onmouseout="this.style.backgroundColor='rgb(131, 97, 3)'">
        <i class="fas fa-bars"></i> Меню
    </button>
    <div x-show="open" @click.away="open = false" x-transition class="absolute bg-white shadow-lg rounded-lg mt-2 w-48 z-10">
        <ul class="py-2">
            @foreach ($links as $link)
                <li>
                    <a href="{{ route($link['route']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex items-center space-x-2">
                        <i class="{{ $link['icon'] }}"></i>
                        <span>{{ $link['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>