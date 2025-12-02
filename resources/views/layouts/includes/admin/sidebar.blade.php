@php
    use Illuminate\Support\Str;

    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'header' => 'Gestión',
        ],
//AQUI CREE MI BOTON DE ROLES Y PERMISOS
       [
        'name' => 'Roles y permisos',
        'icon' => 'fa-solid fa-shield-halved',
    'href' => route('admin.roles.index'),
    'active' => request()->routeIs('admin.roles.*'),
], 
//AQUI CREE MI BOTON DE USUARIOS
[
    'name' => 'Usuarios',
    'icon' => 'fas fa-users',
    'href' => route('admin.usuarios.index'),
    'active' => request()->routeIs('admin.usuarios.*')
],
//AQUI CREE MI BOTON DE MEMBRESIAS

[
    'name' => 'Membresías',
    'icon' => 'fa-solid fa-address-book',
    'href' => route('admin.membresias.index'),
    'active' => request()->routeIs('admin.membresias.*')
],
    ];
@endphp

<aside class="w-64 h-screen bg-white border-r dark:bg-gray-800 dark:border-gray-700 fixed">
    <div class="p-4 border-b dark:border-gray-700 flex items-center space-x-2">
        <div class="w-5 h-5 bg-blue-500 rounded-full"></div>
        <span class="font-bold text-lg text-gray-800 dark:text-white">Simify</span>
    </div>

    <div class="p-4 overflow-y-auto">
        <ul class="space-y-2 text-sm font-medium text-gray-900 dark:text-white">
            @foreach ($links as $link)
                @isset($link['header'])
                    <div class="text-xs font-semibold text-gray-500 uppercase dark:text-gray-400 mt-4">
                        {{ $link['header'] }}
                    </div>
                    @continue
                @endisset

                {{-- Submenu --}}
                @if (isset($link['submenu']))
                    @php $menuId = Str::slug($link['name']); @endphp
                    <li x-data="{ open: true }">
                        <div class="relative">
                            <button @click="open = !open"
                                class="flex items-center justify-between w-full px-3 py-2 text-sm border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <div class="flex items-center space-x-2">
                                    <i class="{{ $link['icon'] }}"></i>
                                    <span>{{ collect($link['submenu'])->firstWhere('active', true)['name'] ?? $link['name'] }}</span>
                                </div>
                                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <ul x-show="open" x-cloak class="mt-2 bg-white border rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                                @foreach ($link['submenu'] as $submenu)
                                    <li>
                                        <a href="{{ $submenu['href'] }}"
                                            class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 {{ $submenu['active'] ? 'bg-blue-100 dark:bg-gray-700 font-semibold' : '' }}">
                                            {{ $submenu['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    {{-- Enlace normal --}}
                    <li>
                        <a href="{{ $link['href'] }}"
                            class="flex items-center px-3 py-2 space-x-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 {{ $link['active'] ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                            <i class="{{ $link['icon'] }}"></i>
                            <span>{{ $link['name'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</aside>

